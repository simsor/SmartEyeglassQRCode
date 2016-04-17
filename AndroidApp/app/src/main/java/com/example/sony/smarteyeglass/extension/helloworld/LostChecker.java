package com.example.sony.smarteyeglass.extension.helloworld;

import android.util.Log;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.MalformedURLException;
import java.net.URL;

/**
 * Created by simon on 17/04/16.
 */
public class LostChecker implements Runnable {

    private HelloWorldControl parent;

    private Thread thread;

    private static final String BASE_URL = "http://quentinchambefort.top/";
    private String url;

    private boolean lost;

    public LostChecker(HelloWorldControl parent) {
        this.parent = parent;
        lost = false;

        url = BASE_URL + "?action=checkIfLost&username=" + HelloWorldActivity.PlayerID;

        thread = new Thread(this);
        thread.start();
    }

    @Override
    public void run() {
        while (true) {
            this.url = BASE_URL + "?action=checkIfLost&username=" + HelloWorldActivity.PlayerID;
            URL url = null;
            try {
                url = new URL(this.url);
                BufferedReader in = new BufferedReader(new InputStreamReader(url.openStream()));
                StringBuffer buf = new StringBuffer();
                String inputLine;
                while ((inputLine = in.readLine()) != null) {
                    buf.append(inputLine);
                }

                String contents = buf.toString();

                in.close();

                if (contents.trim().equals("true")) {
                    // We lost, abandon ship
                    Log.d(Constants.LOG_TAG, "WE LOST");
                    lost = true;
                    parent.lose();
                }
            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }

            try {
                Thread.sleep(1000L);
            } catch (InterruptedException e) {
                e.printStackTrace();
            }
        }
    }
}
