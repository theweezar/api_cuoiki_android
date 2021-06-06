package com.example.resp.requests;

import com.example.resp.WebService;
import com.example.resp.entites.NhanVien;
import com.example.resp.entites.PhongBan;
import com.example.resp.helpers.RequestHelper;

import java.util.HashMap;
import java.util.concurrent.ExecutionException;

public class NhanVienRequest {

    private final RequestHelper requestHelper;

    public NhanVienRequest() {
        requestHelper = new RequestHelper();
    }

    public String doGet(String method) {
        String[] request = {"get", String.format("http://%s/NhanVienController-%s", WebService.host(), method)};
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
        return response;
    }

    public String doPost(NhanVien nhanVien, String method) {
        // Tạo HashMap để tạo requestBody
        HashMap<String, String> hashMap = new HashMap<>();
        hashMap.put("manv", nhanVien.getMaNv());
        hashMap.put("hoten", nhanVien.getHoTen());
        hashMap.put("ngaysinh", nhanVien.getNgaySinh());
        hashMap.put("mapb", nhanVien.getMaPb());

        // Bắt đầu thực hiện request
        requestHelper.buildRequestBody(hashMap);
        String[] request = {"post", String.format("http://%s/NhanVienController-%s", WebService.host(), method)};
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
        return response;
    }
}
