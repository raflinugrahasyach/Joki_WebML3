from flask import Flask, request, jsonify
import joblib
import pandas as pd
import numpy as np

app = Flask(__name__)

# Muat model dan scaler saat aplikasi dimulai
try:
    model = joblib.load('model/svm_model.joblib')
    scaler = joblib.load('model/scaler.joblib')
    print("--- Model dan Scaler berhasil dimuat ---")
except Exception as e:
    print(f"Error memuat model atau scaler: {e}")
    model = None
    scaler = None

@app.route('/predict', methods=['POST'])
def predict():
    if not model or not scaler:
        return jsonify({'error': 'Model tidak dapat dimuat, periksa log server.'}), 500

    # Dapatkan data JSON dari request
    data = request.get_json()
    if not data:
        return jsonify({'error': 'Data tidak ditemukan dalam request.'}), 400

    try:
        # Konversi data ke format yang sesuai dengan urutan kolom saat training
        # Pastikan urutan kolomnya sama persis dengan di train_model.py
        feature_order = [
            'j_kelamin', 'pendidikan', 'pekerjaan', 's_kawin', 
            'anak_sekolah', 'lt_rumah', 'din_rumah', 'dy_listrik', 'sumber_air'
        ]
        
        # Buat list dari data input sesuai urutan yang benar
        input_data = [data[feature] for feature in feature_order]

        # Konversi ke DataFrame untuk scaling
        df_input = pd.DataFrame([input_data], columns=feature_order)

        # Scaling data baru
        scaled_input = scaler.transform(df_input)

        # Lakukan prediksi
        prediction = model.predict(scaled_input)

        # Konversi hasil prediksi ke format yang mudah dibaca
        # Berdasarkan PDF: 1 = Miskin, -1 = Tidak Miskin 
        hasil_prediksi = 'Miskin' if prediction[0] == 1 else 'Tidak Miskin'
        
        # Kirim response
        return jsonify({
            'prediksi_raw': int(prediction[0]),
            'hasil': hasil_prediksi
        })

    except KeyError as e:
        return jsonify({'error': f'Fitur yang dibutuhkan tidak ada: {e}'}), 400
    except Exception as e:
        return jsonify({'error': f'Terjadi kesalahan saat prediksi: {str(e)}'}), 500

if __name__ == '__main__':
    # Jalankan aplikasi di port 5000
    app.run(host='0.0.0.0', port=5000, debug=True)