import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'ESP8266 Wi-Fi Scan',
      theme: ThemeData(
        primarySwatch: Colors.blue,
      ),
      home: WiFiScannerPage(),
    );
  }
}

class WiFiScannerPage extends StatefulWidget {
  @override
  _WiFiScannerPageState createState() => _WiFiScannerPageState();
}

class _WiFiScannerPageState extends State<WiFiScannerPage> {
  List wifiNetworks = [];
  String esp8266Url = "http://<IP_DO_ESP8266>/scan";  // Substitua pelo IP do ESP8266

  // Função para buscar redes Wi-Fi do ESP8266
  Future<void> scanWiFi() async {
    try {
      final response = await http.get(Uri.parse(esp8266Url));

      if (response.statusCode == 200) {
        setState(() {
          wifiNetworks = json.decode(response.body);
        });
      } else {
        throw Exception("Falha ao buscar redes Wi-Fi");
      }
    } catch (e) {
      print("Erro: $e");
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("Wi-Fi Scanner"),
      ),
      body: Column(
        children: [
          ElevatedButton(
            onPressed: scanWiFi,
            child: const Text("Escanear redes Wi-Fi"),
          ),
          Expanded(
            child: ListView.builder(
              itemCount: wifiNetworks.length,
              itemBuilder: (context, index) {
                return ListTile(
                  title: Text("SSID: ${wifiNetworks[index]['ssid']}"),
                  subtitle: Text("Sinal: ${wifiNetworks[index]['rssi']} dBm"),
                );
              },
            ),
          ),
        ],
      ),
    );
  }
}

