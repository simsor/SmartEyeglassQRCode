package com.example.sony.smarteyeglass.extension.helloworld;

import android.util.JsonReader;
import android.util.Log;

import org.json.*;

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

    private static final String BASE_URL = "http://quentinchambefort.top/";

    private HelloWorldControl parent;

    public WebsiteClient(HelloWorldControl parent, String treasure_id, String username) {
        thread = new Thread(this);
        this.parent = parent;
        this.url = BASE_URL + "?action=validateTreasure&username=" + username + "&treasure_id=" + treasure_id;

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

            JSONObject object = new JSONObject(contents);
            String state = object.getString("state");

            if (state.equals("success")) {
                parent.onValidateSuccess(object.getString("hint"));
            } else {
                parent.onValidateError(object.getString("error"));
            }

        } catch (MalformedURLException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }
}
