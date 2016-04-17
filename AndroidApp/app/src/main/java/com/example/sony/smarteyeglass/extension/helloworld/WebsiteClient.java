package com.example.sony.smarteyeglass.extension.helloworld;

import android.util.Log;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.MalformedURLException;
import java.net.URL;

/**
 * Created by simon on 17/04/16.
 * Connects to the given URL
 */
public class WebsiteClient implements Runnable {

    private Thread thread;
    private String url;

    public WebsiteClient(String url) {
        thread = new Thread(this);
        this.url = url;

        thread.start();
    }

    @Override
    public void run() {
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
            Log.d(Constants.LOG_TAG, contents);
        } catch (MalformedURLException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}
