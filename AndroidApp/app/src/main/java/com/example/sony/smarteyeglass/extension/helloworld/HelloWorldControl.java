/*
Copyright (c) 2011, Sony Mobile Communications Inc.
Copyright (c) 2014, Sony Corporation

 All rights reserved.

 Redistribution and use in source and binary forms, with or without
 modification, are permitted provided that the following conditions are met:

 * Redistributions of source code must retain the above copyright notice, this
 list of conditions and the following disclaimer.

 * Redistributions in binary form must reproduce the above copyright notice,
 this list of conditions and the following disclaimer in the documentation
 and/or other materials provided with the distribution.

 * Neither the name of the Sony Mobile Communications Inc.
 nor the names of its contributors may be used to endorse or promote
 products derived from this software without specific prior written permission.

 THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
 FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
 OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */
package com.example.sony.smarteyeglass.extension.helloworld;

import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Canvas;
import android.graphics.Paint;
import android.graphics.Rect;
import android.text.format.Time;
import android.util.DisplayMetrics;
import android.util.Log;

import com.google.zxing.BinaryBitmap;
import com.google.zxing.ChecksumException;
import com.google.zxing.FormatException;
import com.google.zxing.LuminanceSource;
import com.google.zxing.NotFoundException;
import com.google.zxing.RGBLuminanceSource;
import com.google.zxing.Reader;
import com.google.zxing.Result;
import com.google.zxing.common.HybridBinarizer;
import com.google.zxing.datamatrix.DataMatrixReader;
import com.google.zxing.qrcode.QRCodeReader;
import com.sony.smarteyeglass.SmartEyeglassControl;
import com.sony.smarteyeglass.extension.util.CameraEvent;
import com.sony.smarteyeglass.extension.util.ControlCameraException;
import com.sony.smarteyeglass.extension.util.SmartEyeglassControlUtils;
import com.sony.smarteyeglass.extension.util.SmartEyeglassEventListener;
import com.sonyericsson.extras.liveware.aef.control.Control;
import com.sonyericsson.extras.liveware.extension.util.control.ControlExtension;
import com.sonyericsson.extras.liveware.extension.util.control.ControlTouchEvent;

/**
 * Demonstrates how to communicate between an Android activity and its
 * corresponding SmartEyeglass app.
 *
 */
public final class HelloWorldControl extends ControlExtension {

    /** Instance of the SmartEyeglass Control Utility class. */
    private final SmartEyeglassControlUtils utils;

    /** The SmartEyeglass API version that this app uses */
    private static final int SMARTEYEGLASS_API_VERSION = 1;

    private boolean cameraStarted;
    private boolean currentlyTakingPicture;

    /**
     * Shows a simple layout on the SmartEyeglass display and sets
     * the text content dynamically at startup.
     * Tap on the device controller touch pad to start the Android activity
     * for this app on the phone.
     * Tap the Android activity button to run the SmartEyeglass app.
     *
     * @param context            The context.
     * @param hostAppPackageName Package name of SmartEyeglass host application.
     */
    public HelloWorldControl(final Context context,
            final String hostAppPackageName, final String message) {
        super(context, hostAppPackageName);

        // Create the listener for the Camera
        SmartEyeglassEventListener listener = new SmartEyeglassEventListener() {
            @Override
            public void onCameraReceived(CameraEvent event) {
                // The picture has been taken
                Log.d(Constants.LOG_TAG, "Picture taken");
                processPicture(event);
            }

            @Override
            public void onCameraErrorReceived(int error) {
                Log.d(Constants.LOG_TAG, "AN ERROR OCCURED: " + error);
            }
        };

        // "utils" is a set of useful functions to work with the glasses
        utils = new SmartEyeglassControlUtils(hostAppPackageName, listener);
        utils.setRequiredApiVersion(SMARTEYEGLASS_API_VERSION);
        utils.activate(context);

        utils.setCameraMode(SmartEyeglassControl.Intents.CAMERA_JPEG_QUALITY_FINE,
                SmartEyeglassControl.Intents.CAMERA_RESOLUTION_3M,
                SmartEyeglassControl.Intents.CAMERA_MODE_STILL);

        /*
         * Set reference back to this Control object
         * in ExtensionService class to allow access to SmartEyeglass Control
         */
        HelloWorldExtensionService.Object.SmartEyeglassControl = this;

        updateLayout("");
        cameraStarted = false;
        currentlyTakingPicture = false;
    }

    /**
     * Provides a public method for ExtensionService and Activity to call in
     * order to request start.
     */
    public void requestExtensionStart() {
        startRequest();
    }

    // Update the SmartEyeglass display when app becomes visible
    @Override
    public void onResume() {
        cameraStarted = false;
        currentlyTakingPicture = false;
        utils.setCameraMode(SmartEyeglassControl.Intents.CAMERA_JPEG_QUALITY_FINE,
                SmartEyeglassControl.Intents.CAMERA_RESOLUTION_3M,
                SmartEyeglassControl.Intents.CAMERA_MODE_STILL);
        updateLayout("Tap to take picture");
        super.onResume();
    }

    // Clean up data structures on termination.
    @Override
    public void onDestroy() {
        Log.d(Constants.LOG_TAG, "onDestroy: HelloWorldControl");
        utils.stopCamera();
        utils.deactivate();
    }

    /**
     * Process Touch events.
     * This starts the Android Activity for the app, passing a startup message.
     */
    @Override
    public void onTouch(final ControlTouchEvent event) {
        super.onTouch(event);

        if (event.getAction() == Control.TapActions.SINGLE_TAP) {
            Log.d(Constants.LOG_TAG, "Tapped");

            if (!cameraStarted) {
                initializeCamera();
            }

            if (!currentlyTakingPicture) {
                currentlyTakingPicture = true;
                utils.requestCameraCapture();
                updateLayout("Snapping a picture...");
            }
        }
    }

    /**
     *  Update the display with the dynamic message text.
     */
    private void updateLayout(String Text) {
        showLayout(R.layout.layout, null);
        sendText(R.id.btn_update_this, Text);
    }

    /**
     * Timeout dialog messages are similar to Toast messages on
     * Android Activities
     * This shows a timeout dialog with the specified message.
     */
    public void showToast(final String message) {
        utils.showDialogMessage(message,
                SmartEyeglassControl.Intents.DIALOG_MODE_TIMEOUT);
    }

    /**
     * Call the startCamera, and start video recording or shooting.
     */
    private void initializeCamera() {
        try {
            // Start camera without filepath for other recording modes
            Log.d(Constants.LOG_TAG, "startCamera ");
            utils.startCamera();
        } catch (ControlCameraException e) {
            Log.d(Constants.LOG_TAG, "Failed to register listener", e);
        }
        Log.d(Constants.LOG_TAG, "onResume: Registered listener");

        cameraStarted = true;
    }

    public void processPicture(CameraEvent event) {
        updateLayout("");

        if (event.getIndex() == 0) {
            if (event.getData() != null && event.getData().length > 0) {
                byte[] data = event.getData();
                Bitmap bitmap = BitmapFactory.decodeByteArray(data, 0, data.length);

                int[] intArray = new int[bitmap.getWidth() * bitmap.getHeight()];
                //copy pixel data from the Bitmap into the 'intArray' array
                bitmap.getPixels(intArray, 0, bitmap.getWidth(), 0, 0, bitmap.getWidth(), bitmap.getHeight());

                LuminanceSource source = new RGBLuminanceSource(bitmap.getWidth(), bitmap.getHeight(), intArray);

                BinaryBitmap bbmap = new BinaryBitmap(new HybridBinarizer(source));
                Reader reader = new QRCodeReader();
                try {
                    currentlyTakingPicture = false;
                    Result result = reader.decode(bbmap);
                    Log.d(Constants.LOG_TAG, result.getText());

                    updateLayout(result.getText());
                } catch (NotFoundException e) {
                    e.printStackTrace();
                } catch (ChecksumException e) {
                    e.printStackTrace();
                } catch (FormatException e) {
                    e.printStackTrace();
                }
            }
        }
    }


}
