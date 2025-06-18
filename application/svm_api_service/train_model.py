import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import StandardScaler
from sklearn.svm import SVC
from sklearn.metrics import classification_report, accuracy_score
import joblib
import os

print("--- Memulai Proses Pelatihan Model SVM (Struktur CSV Baru) ---")

# 1. Muat Dataset
try:
    # Membaca CSV dan langsung menentukan kolom mana yang akan digunakan
    use_cols = [
        'Jenis Kelamin', 'Pendidikan', 'Pekerjaan', 'Status Perkawinan', 
        'Tanggungan Anak', 'Lantai Rumah', 'Dinding Rumah', 'Daya Listrik', 
        'Sumber Air', 'Kelas'
    ]
    df = pd.read_csv('dummy_penduduk_desa_taraju.csv', usecols=use_cols)
    print("Dataset 'dummy_penduduk_desa_taraju.csv' berhasil dimuat.")
    print(f"Menggunakan kolom: {df.columns.tolist()}")

except FileNotFoundError:
    print("Error: File 'dummy_penduduk_desa_taraju.csv' tidak ditemukan.")
    exit()
except ValueError as e:
    print(f"Error: Kolom di CSV tidak sesuai. Pastikan semua kolom berikut ada: {use_cols}. Detail error: {e}")
    exit()


# 2. Encoding: Mengubah Data Teks menjadi Angka
encoding_maps = {
    'Jenis Kelamin':      {'Laki-laki': 1, 'Perempuan': 2},
    'Pendidikan':         {'Perguruan Tinggi': 1, 'SLTA': 2, 'SLTP': 3, 'SD': 4},
    'Pekerjaan':          {'Pegawai/Karyawan': 1, 'Dagang': 2, 'Tani': 3, 'Buruh': 4, 'Tidak Bekerja': 5},
    'Status Perkawinan':  {'Kawin': 1, 'Duda': 2, 'Janda': 3},
    'Lantai Rumah':       {'Keramik': 1, 'Tembok': 2, 'Kayu/bambu': 3},
    'Dinding Rumah':      {'Tembok': 1, 'Semi-tembok': 2, 'Kayu/bambu': 3},
    'Daya Listrik':       {900: 1, 450: 2},
    'Sumber Air':         {'PAM/berbayar': 1, 'Sumur': 2, 'Mata air/sungai': 3}
}

df_encoded = df.copy()
for column, mapping in encoding_maps.items():
    if column in df_encoded.columns:
        df_encoded[column] = df_encoded[column].map(mapping)

if df_encoded.isnull().values.any():
    print("\nPERINGATAN: Ditemukan nilai kosong (NaN) setelah proses encoding!")
    exit()
else:
    print("\nProses encoding data teks ke numerik selesai. Tidak ada nilai kosong ditemukan.")


# 3. Pisahkan Fitur (X) dan Target (y)
X = df_encoded.drop('Kelas', axis=1)
y = df_encoded['Kelas']


# 4. Pisahkan Data Latih dan Uji
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42, stratify=y)


# 5. Scaling Fitur
scaler = StandardScaler()
X_train_scaled = scaler.fit_transform(X_train)
# PERBAIKAN: Menambahkan baris yang hilang untuk melakukan scaling pada data uji
X_test_scaled = scaler.transform(X_test) 
print("\nScaling fitur untuk data latih dan uji berhasil dilakukan.")


# 6. Latih Model SVM
svm_model = SVC(kernel='linear', class_weight='balanced', random_state=42)
svm_model.fit(X_train_scaled, y_train)
print("Model SVM berhasil dilatih.")


# 7. Evaluasi Model
y_pred = svm_model.predict(X_test_scaled) # Baris ini sekarang akan berjalan tanpa error
print("\n--- Hasil Evaluasi Model pada Data Uji ---")
print(f"Akurasi: {accuracy_score(y_test, y_pred):.4f}")
print("\nLaporan Klasifikasi:")
print(classification_report(y_test, y_pred, target_names=['Tidak Miskin (-1)', 'Miskin (1)'], zero_division=0))
print("---------------------------------------------")


# 8. Simpan Model dan Scaler
output_dir = 'model'
if not os.path.exists(output_dir):
    os.makedirs(output_dir)

joblib.dump(svm_model, os.path.join(output_dir, 'svm_model.joblib'))
joblib.dump(scaler, os.path.join(output_dir, 'scaler.joblib'))

print(f"\nModel dan Scaler berhasil disimpan di folder '{output_dir}'.")
print("\n--- PROSES PELATIHAN SELESAI DENGAN SUKSES ---")

