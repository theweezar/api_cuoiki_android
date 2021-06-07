package com.example.resp.testers;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.Manifest;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.os.Build;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Toast;

import com.example.resp.R;
import com.example.resp.entites.VanPhongPham;
import com.example.resp.requests.VanPhongPhamRequest;

import java.io.File;

public class TestVanPhongPham extends AppCompatActivity {

    EditText mavpp_input;
    EditText tenvpp_input;
    EditText dvt_input;
    EditText gianhap_input;
    EditText soluong_input;
    EditText mancc_input;
    ImageView hinh_input;
    Button upload_btn;
    Button submit_btn;

    File file_hinh;

    int IMAGE_FOLDER = 1000;
    int PERMISSION_GRANTED = 1001;

    VanPhongPhamRequest vanPhongPhamRequest;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_test_van_phong_pham);
        setControll();
        setEventForImageUpload();
        setEvent();
    }

    public void setControll() {
        vanPhongPhamRequest = new VanPhongPhamRequest();
        file_hinh = null;
        mavpp_input = (EditText)findViewById(R.id.mavpp);
        tenvpp_input = (EditText)findViewById(R.id.tenvpp);
        dvt_input = (EditText)findViewById(R.id.dvt);
        gianhap_input = (EditText)findViewById(R.id.gianhap);
        soluong_input = (EditText)findViewById(R.id.soluong);
        mancc_input = (EditText)findViewById(R.id.mancc);
        hinh_input = (ImageView)findViewById(R.id.hinh_input);
        upload_btn = (Button)findViewById(R.id.upload_btn);
        submit_btn = (Button)findViewById(R.id.submit_btn);
    }

    public void setEvent() {
        submit_btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String maVpp = mavpp_input.getText().toString().trim();
                String tenVpp = tenvpp_input.getText().toString().trim();
                String dvt = dvt_input.getText().toString().trim();
                String giaNhap = gianhap_input.getText().toString().trim();
                String soLuong = soluong_input.getText().toString().trim();
                String maNcc = mancc_input.getText().toString().trim();
                VanPhongPham vanPhongPham = new VanPhongPham(maVpp, tenVpp, dvt, giaNhap, null, soLuong, maNcc);
                String response = vanPhongPhamRequest.doPost(vanPhongPham, file_hinh, "insert");
                Log.d("vanphongpham", response);
            }
        });
    }

    public void pickImageFromStorage(){
        Intent intent = new Intent(Intent.ACTION_PICK);
        intent.setType("image/*");
        startActivityForResult(intent, IMAGE_FOLDER);
    }

    public void setEventForImageUpload(){
        upload_btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M){
                    if (checkSelfPermission(Manifest.permission.READ_EXTERNAL_STORAGE) == PackageManager.PERMISSION_DENIED){
                        String[] permissions = {Manifest.permission.READ_EXTERNAL_STORAGE};
                        requestPermissions(permissions, PERMISSION_GRANTED);
                    }
                    else{
                        pickImageFromStorage();
                    }
                }
                else{
                    pickImageFromStorage();
                }
            }
        });
    }

    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        if (requestCode == PERMISSION_GRANTED){
            if (grantResults.length > 0 && grantResults[0] == PackageManager.PERMISSION_GRANTED){
                pickImageFromStorage();
            }
        }
        else{
            Toast.makeText(TestVanPhongPham.this,"Từ chối quyền truy cập", Toast.LENGTH_SHORT).show();
        }
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        if (requestCode == IMAGE_FOLDER && resultCode == RESULT_OK && data != null){
            hinh_input.setImageURI(data.getData());
            file_hinh = new File(data.getData().getPath());
            Toast.makeText(TestVanPhongPham.this,
                    String.format("Thêm hình thành công ở %s", file_hinh.getAbsolutePath()),
                    Toast.LENGTH_SHORT).show();
        }
        super.onActivityResult(requestCode, resultCode, data);
    }
}