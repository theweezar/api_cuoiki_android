package com.example.resp.testers;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.widget.ImageView;
import android.widget.LinearLayout;

import com.example.resp.R;
import com.example.resp.WebService;
import com.example.resp.helpers.ImageLoadHelper;
import com.squareup.picasso.RequestCreator;

import java.util.concurrent.ExecutionException;

public class TestLazyLoadImage extends AppCompatActivity {

    LinearLayout main_layout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_test_lazy_load_image);
        setControl();
        loadImage();
    }

    public void setControl() {
        main_layout = (LinearLayout) findViewById(R.id.main_layout);
    }

    public void loadImage() {
        String[] imageNames = {
                "2.png", "3.png", "asd.png", "pmfbdjvhoa.jpg", "skhtuphres.jpg"
        };
        for(int i = 0; i < imageNames.length; i++) {
            ImageView imageView = new ImageView(TestLazyLoadImage.this);
            imageView.setId(i);
            imageView.setLayoutParams(new LinearLayout.LayoutParams(LinearLayout.LayoutParams.MATCH_PARENT,
                    LinearLayout.LayoutParams.WRAP_CONTENT));
            imageView.setPadding(0,2,0,2);

            try {
                String[] imageUri = {String.format("http://%s/ImageController-get?hinh=%s",
                        WebService.host(), imageNames[i])};
                ImageLoadHelper imageLoadHelper = new ImageLoadHelper();
                RequestCreator requestCreator = imageLoadHelper.execute(imageUri).get();
                requestCreator.into(imageView);
            }
            catch(ExecutionException | InterruptedException ignored) {
            }

            main_layout.addView(imageView);
        }
    }
}