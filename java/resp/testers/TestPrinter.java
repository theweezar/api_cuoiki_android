package com.example.resp.testers;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Build;
import android.os.Bundle;
import android.text.Html;
import android.webkit.WebView;
import android.widget.TextView;

import com.example.resp.R;
import com.example.resp.WebService;
import com.example.resp.helpers.RequestHelper;

import java.util.concurrent.ExecutionException;

public class TestPrinter extends AppCompatActivity {

    WebView htmlView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_test_printer);
        setControl();
        displayHtml();
    }

    @Override
    protected void onDestroy() {
        super.onDestroy();
        if (htmlView != null) {
            htmlView.destroy();
        }
    }

    public void setControl() {
        htmlView = (WebView)findViewById(R.id.htmlView);
    }

    public void displayHtml() {
        RequestHelper requestHelper = new RequestHelper();
        String[] request = {"get", String.format("http://%s/PrinterController-printDocs", WebService.host())};
        String response = "";
        try {
            response = requestHelper.execute(request).get();
        }
        catch(ExecutionException e){
            response = e.getMessage();
        }
        catch(InterruptedException e){
            response = e.getMessage();
        }

        htmlView.loadData(response, "text/html", "UTF-8");
    }
}