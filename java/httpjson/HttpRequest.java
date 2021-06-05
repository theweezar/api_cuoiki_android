/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package httpjson;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import org.json.*;
import entities.*;
import java.io.ByteArrayOutputStream;
import java.io.ObjectOutputStream;

/**
 *
 * @author hpmdu
 */
public class HttpRequest {
    public static void main(String[] args) throws MalformedURLException, IOException {
        
        HttpRequest http = new HttpRequest();
        
        String phongbanJson = http.requestHttp("http://192.168.1.6/PhongBanController-show");
        http.parseJSON(phongbanJson, "PhongBan");
        System.out.println();
        String nhanvienJson = http.requestHttp("http://192.168.1.6/NhanVienController-show");
        http.parseJSON(nhanvienJson, "NhanVien");
        System.out.println();
        String vppJson = http.requestHttp("http://192.168.1.6/VanPhongPhamController-show");
        http.parseJSON(vppJson, "VanPhongPham");
    }
    public String requestHttp(String request) {
        try {
            URL url = new URL(request);
            HttpURLConnection httpConn = (HttpURLConnection) url.openConnection();
            httpConn.setRequestMethod("GET");
            BufferedReader br = new BufferedReader(new InputStreamReader(httpConn.getInputStream()));

            String input;
            String result = "";

            while ((input = br.readLine()) != null){
                result += input;
            }
            
            br.close();
            return result;
        }
        catch (MalformedURLException malformedURLException) {
            malformedURLException.printStackTrace();
        }
        catch (IOException iOException) {
            iOException.printStackTrace();
        }
        return "";
    }
    
    public void parseJSON(String json, String objectName) {
        JSONObject jsonObj = new JSONObject(json);
        JSONArray viewData = jsonObj.getJSONArray("viewData");
        System.out.println(json);
        
        if (objectName.trim().equals("PhongBan")) {    
            for(int i = 0; i < viewData.length(); i++) {
                PhongBan phongBan = new PhongBan(viewData.getJSONObject(i).getString("MAPB"), 
                        viewData.getJSONObject(i).getString("TENPB"));
                System.out.println(phongBan.toString());
            }
        }
        
        if (objectName.trim().equals("NhanVien")) {
            for(int i = 0; i < viewData.length(); i++) {
                NhanVien nhanVien = new NhanVien(
                        viewData.getJSONObject(i).getString("MANV"), 
                        viewData.getJSONObject(i).getString("HOTEN"),
                        viewData.getJSONObject(i).getString("NGAYSINH"),
                        viewData.getJSONObject(i).getString("MAPB")
                );
                System.out.println(nhanVien.toString());
            }
        }
        
        if (objectName.trim().equals("VanPhongPham")) {
            for(int i = 0; i < viewData.length(); i++) {                
                VanPhongPham vanPhongPham = new VanPhongPham(
                        viewData.getJSONObject(i).getString("MAVPP"),
                        viewData.getJSONObject(i).getString("TENVPP"),
                        viewData.getJSONObject(i).getString("DVT"),
                        viewData.getJSONObject(i).getString("GIANHAP"),
                        viewData.getJSONObject(i).get("HINH").toString(),
                        viewData.getJSONObject(i).getInt("SOLUONG"),
                        viewData.getJSONObject(i).getString("MANCC")
                );
                
                System.out.println(vanPhongPham.toString());
            }
        }
        
        if (objectName.trim().equals("CapPhat")) {
            
        }
        
        if (objectName.trim().equals("NhaCungCap")) {
            
        }
        
        if (objectName.trim().equals("PhieuCungCap")) {
            
        }
    }
}
