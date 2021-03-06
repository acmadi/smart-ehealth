<?php

namespace backend\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "registrasi".
 *
 * @property integer $id
 * @property string $no_reg
 * @property integer $pasien_id
 * @property string $tanggal_registrasi
 * @property string $status_registrasi
 * @property string $asal_registrasi 
 * @property string $status_pelayanan
 * @property string $tanggal_kunjungan
 * @property string $status_rawat
 * @property string $dr_penanggung_jawab
 * @property integer $icdx_id
 * @property string $status_asuransi
 * @property string $catatan
 * @property string $asuransi_noreg
 * @property string $asuransi_noreg_other
 * @property string $asuransi_nama
 * @property string $asuransi_tgl_lahir
 * @property string $asuransi_status_jaminan
 * @property string $asuransi_penanggung_jawab
 * @property string $asuransi_alamat
 * @property string $asuransi_notelp
 * @property integer $no_antrian 
 * @property integer $asuransi_provider_id 
 * @property integer $faskes_id 
 * @property integer $no_resep_racikan
 * @property integer $no_resep_nonracikan
 *
 * @property Anamnesa[] $anamnesas
 * @property AsuransiProvider $asuransiProvider 
 * @property FasilitasKesehatan $faskes 
 * @property Icdx $icdx
 * @property Pasien $pasien
 */
class Registrasi extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'registrasi';
    }

    /**
     * @inheritdoc
     */
    public $pasienNama;
    public $tanggal_registrasi_format;
    public $tanggal_kunjungan_format;
    public $nomorRegistrasi;
    public $jenis_kelamin;
    public $faskesnama;
    public $no_rm;
    public $fasilitas_kesehatan;
    public $format_noreg;
    
    //edit popup registri
    public $status_rawat_reged;
    public $dr_penanggung_jawab_reged;
    public $icdx_id_reged;
    public $catatan_reged;
    public $status_asuransi_reged;
    public $asuransi_provider_id_reged;
    public $asuransi_penanggung_jawab_reged;
    public $asuransi_alamat_reged;
    public $asuransi_notelp_reged;
    public $asuransi_noreg_reged;
    public $asuransi_nama_reged;
    public $asuransi_tgl_lahir_reged;
    public $asuransi_status_jaminan_reged;

    public function rules() {
        return [
            [['pasien_id', 'status_pelayanan'], 'required'],
            [['pasien_id', 'asuransi_provider_id', 'icdx_id', 'no_antrian', 'faskes_id', 'nomorRegistrasi', 'usia'], 'integer'],
            [['tanggal_registrasi','tanggal_kunjungan', 'asuransi_tgl_lahir', 'no_rm', 'jenis_kelamin', 'fasilitas_kesehatan', 'faskes'], 'safe'],
            [['status_registrasi', 'asal_registrasi', 'status_pelayanan', 'status_rawat', 'status_asuransi', 'catatan'], 'string'],
            [['no_reg', 'asuransi_noreg', 'asuransi_noreg_other', 'asuransi_notelp'], 'string', 'max' => 15],
            [['dr_penanggung_jawab', 'asuransi_nama'], 'string', 'max' => 25],
            [['asuransi_status_jaminan', 'asuransi_penanggung_jawab', 'asuransi_alamat'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'no_reg' => 'No Registrasi',
            'pasien_id' => 'Pasien',
            'tanggal_registrasi' => 'Tanggal Registrasi',
            'status_registrasi' => 'Status Registrasi',
            'status_pelayanan' => 'Status Pelayanan',
            'status_rawat' => 'Status Rawat',
            'dr_penanggung_jawab' => 'Dokter Penanggung Jawab',
            'icdx_id' => 'Diagnosa',
            'status_asuransi' => 'Status Asuransi',
            'catatan' => 'Catatan',
            'asuransi_noreg' => 'No Reg Asuransi',
            'asuransi_noreg_other' => 'No Reg Asuransi',
            'asuransi_nama' => 'Nama Asuransi',
            'asuransi_tgl_lahir' => 'Tanggal Lahir',
            'asuransi_status_jaminan' => 'Status Jaminan',
            'asuransi_penanggung_jawab' => 'Penanggung Jawab',
            'asuransi_alamat' => 'Alamat',
            'asuransi_notelp' => 'No Telepon/HP',
            'asuransi_provider_id' => 'Asuransi',
            'faskes_id' => 'Faskes ID',
            'usia' => 'Usia',
            'kategoriUsia' => 'Kategori Usia',
            'nomorRegistrasi' => 'No Registrasi',
            'no_rm' => 'No RM',
            'jenis_kelamin' => 'Jenis Kelamin',
            'fasilitas_kesehatan' => 'Fasilitas Kesehatan',
            'format_noreg' => 'No Registrasi',
            'tanggal_kunjungan_format' => 'Tgl Kunjung'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnamnesas() {
        return $this->hasMany(Anamnesa::className(), ['registrasi_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIcdx() {
        return $this->hasOne(Icdx::className(), ['id' => 'icdx_id']);
    }

    /**
     * @return \yii\db\ActiveQuery 
     */
    public function getAsuransiProvider() {
        return $this->hasOne(AsuransiProvider::className(), ['id' => 'asuransi_provider_id']);
    }

    /**
     * @return \yii\db\ActiveQuery 
     */
    public function getFaskes() {
        return $this->hasOne(FasilitasKesehatan::className(), ['id' => 'faskes_id']);
    }

    public function getPasien() {
        return $this->hasOne(Pasien::className(), ['id' => 'pasien_id']);
    }

    public function getUsia() {
        try {
            $birthDay = new \DateTime($this->pasien->tgl_lahir);
            $now = new \DateTime();
            $diff = $now->diff($birthDay);
            return $diff->format('%y'); 
        }
        catch(\Exception $e) {
            return 0;
        }
    }

    public function getKategoriUsia() {
        // Bayi 0 - 11 bulan => 0
        // Anak 1 - 12 tahun => 1
        // Dewasa > 12 tahun => 2

        try {
            $birthDay = new \DateTime($this->pasien->tgl_lahir);
            $now = new \DateTime();
            $diff = $now->diff($birthDay);
            $totalmonth = $diff->format('%y') * 12 + $diff->format('%m');

            if($totalmonth > 12 * 12) {
                return 2;
            }
            else if($totalmonth >= 12 && $totalmonth <= 12 * 12) {
                return 1;
            }
            else 
                return 0;

        }
        catch(\Exception $e) {
            return 0;
        }
    }

    public function afterFind() {
        if($this->isNewRecord){
            $birthDay = new \DateTime($this->pasien->tgl_lahir);
            $now = new \DateTime();
            $diff = $now->diff($birthDay); 

            $this->fasilitas_kesehatan = $this->faskes->nama;
            $this->jenis_kelamin = $this->pasien->jenkel;
            $this->no_rm = str_pad($this->pasien->id, 6, '0', STR_PAD_LEFT);
            $this->nomorRegistrasi = $this->asal_registrasi[0].'-'.str_pad($this->id, 6, '0', STR_PAD_LEFT);
        }
    }

//    public function beforeSave($insert) {
//        if (parent::beforeSave($insert)) {
//
//            if($this->isNewRecord) {
//                $this->status_registrasi = 'Antrian';
//            }
//
//            return true;
//
//        } else {
//            return false;
//        }
//    }

    public function getNoAntrian($date_f, $faskes_id) {

        $tanggal_kunjungan = date_create(str_replace(' ','',$date_f).' 00:00:00');
        $noantrian = Registrasi::find()->select('count(id)')
            ->where('date_format(tanggal_kunjungan,"%Y-%m-%d") = "'.$tanggal_kunjungan->format('Y-m-d').'" and faskes_id = '.$faskes_id.'')->scalar();

        return $noantrian + 1;
        
    }
}
