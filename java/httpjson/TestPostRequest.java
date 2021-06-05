package com.example.resp;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import java.util.HashMap;
import java.util.concurrent.ExecutionException;

public class TestPostRequest extends AppCompatActivity {


    EditText mapb_input;
    EditText tenpb_input;
    Button submit;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_test_post_request);
        setControll();
        setEvent();
    }

    public void setControll() {
        mapb_input = (EditText)findViewById(R.id.mapb);
        tenpb_input = (EditText)findViewById(R.id.tenpb);
        submit = (Button)findViewById(R.id.submit);
    }

    public void setEvent() {
        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String mapb = mapb_input.getText().toString().trim();
                String tenpb = tenpb_input.getText().toString().trim();

                // Tạo HashMap để tạo requestBody
                HashMap<String, String> hashMap = new HashMap<>();
                hashMap.put("mapb", mapb);
                hashMap.put("tenpb", tenpb);


                // Bắt đầu thực hiện request
                RequestHelper requestHelper = new RequestHelper();
                requestHelper.buildRequestBody(hashMap);
                String[] request = {"post", String.format("http://%s/PhongBanController-insert", WebService.host())};
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
                Toast.makeText(TestPostRequest.this, response, Toast.LENGTH_SHORT).show();
                Log.d("JSON", response);
            }
        });
    }

}