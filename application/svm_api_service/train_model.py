import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import StandardScaler
from sklearn.svm import SVC
import joblib

print("--- Memulai Proses Training Model ---")

# 1. Muat dan Encode Data (sesuai .ipynb dan PDF)
df = pd.read_csv('dummy_penduduk_desa_taraju.csv')

gender_map = {'Laki-laki': 1, 'Perempuan': 2}
pendidikan_map = {'Perguruan Tinggi': 1, 'SLTA': 2, 'SLTP': 3, 'SD': 4}
pekerjaan_map = {'Pegawai/Karyawan': 1, 'Dagang': 2, 'Tani': 3, 'Buruh': 4, 'Tidak Bekerja': 5}
status_perkawinan_map = {'Kawin': 1, 'Duda': 2, 'Janda': 3}
lantai_rumah_map = {'Keramik': 1, 'Tembok': 2, 'Kayu/bambu': 3}
dinding_rumah_map = {'Tembok': 1, 'Semi-tembok': 2, 'Kayu/bambu': 3}
daya_listrik_map = {900: 1, 450: 2}
sumber_air_map = {'PAM/berbayar': 1, 'Sumur': 2, 'Mata air/sungai': 3}

df_encoded = df.copy()
df_encoded['Jenis Kelamin'] = df_encoded['Jenis Kelamin'].map(gender_map)
df_encoded['Pendidikan'] = df_encoded['Pendidikan'].map(pendidikan_map)
df_encoded['Pekerjaan'] = df_encoded['Pekerjaan'].map(pekerjaan_map)
df_encoded['Status Perkawinan'] = df_encoded['Status Perkawinan'].map(status_perkawinan_map)
df_encoded['Lantai Rumah'] = df_encoded['Lantai Rumah'].map(lantai_rumah_map)
df_encoded['Dinding Rumah'] = df_encoded['Dinding Rumah'].map(dinding_rumah_map)
df_encoded['Daya Listrik'] = df_encoded['Daya Listrik'].map(daya_listrik_map)
df_encoded['Sumber Air'] = df_encoded['Sumber Air'].map(sumber_air_map)

# Ganti nama kolom agar sesuai dengan PHP
df_encoded.rename(columns={
    'Jenis Kelamin': 'j_kelamin',
    'Pendidikan': 'pendidikan',
    'Pekerjaan': 'pekerjaan',
    'Status Perkawinan': 's_kawin',
    'Tanggungan Anak': 'anak_sekolah',
    'Lantai Rumah': 'lt_rumah',
    'Dinding Rumah': 'din_rumah',
    'Daya Listrik': 'dy_listrik',
    'Sumber Air': 'sumber_air'
}, inplace=True)


# 2. Pisahkan Fitur (X) dan Target (y)
X = df_encoded.drop('Kelas', axis=1)
y = df_encoded['Kelas']

# 3. Scaling
scaler = StandardScaler()
X_scaled = scaler.fit_transform(X)

# 4. Latih model SVM
svm_model = SVC(kernel='linear', C=1.0, random_state=42)
svm_model.fit(X_scaled, y)

print(f"Akurasi model pada keseluruhan data: {svm_model.score(X_scaled, y):.4f}")

# 5. Simpan Model dan Scaler
joblib.dump(svm_model, 'model/svm_model.joblib')
joblib.dump(scaler, 'model/scaler.joblib')

print("--- Model dan Scaler berhasil disimpan di folder 'model/' ---")