@extends('index')
@section('content')
    <div class="col-md-12 stretch-card grid-margin">
        <div class="card">
            <div class="card-body">
                <p class="card-title">SPK</p>
                <form id="save" method="POST">
                    @if (auth()->guard('admin')->check())
                        <textarea id="myTextarea">
                        <div style="text-align: center; line-height: 1.5;"><strong>MEMORANDUM OF UNDERSTANDING </strong></div>
                        <div style="text-align: center; line-height: 1.5;"><strong>(NOTA KESEPAKATAN)</strong></div>
                        <div style="text-align: center; line-height: 1.5;">&nbsp;</div>
                        <div style="text-align: center; line-height: 1.5;"><strong>ANTARA </strong></div>
                        <div style="text-align: center; line-height: 1.5;">PT. DATA BUANA NUSANTARA&nbsp;<strong><br>&nbsp;<br></strong></div>
                        <div style="text-align: center; line-height: 1.5;"><strong>DENGAN</strong></div>
                        <div style="text-align: center; line-height: 1.5;"></div>
                        <div style="text-align: center; line-height: 1.5;">&nbsp;</div>
                        <div style="line-height: 1.5; text-align: justify;">Pada Hari ini <strong></strong>, tanggal <strong> bulan </strong> tahun <strong>{{ $tahun }} </strong>bertempat di Blitar, PARA PIHAK yang&nbsp;bertanda tangan dibawah ini :</div>
                        <div style="line-height: 1.5;">
                        <ol style="text-align: justify;">
                        <li style="text-align: justify; line-height: 1.5;"><strong>Muhamad Khotib</strong>, Direktur Utama dalam hal ini bertindak untuk dan atas nama PT. Data Buana Nusantara, yang berkedudukan di Ds Tawangrejo, Kecamatan Wonodadi, Kabupaten Blitar, Jawa Timur, untuk selanjutnya disebut sebagai <strong>PIHAK PERTAMA</strong></li>
                        <li style="text-align: justify; line-height: 1.5;"><strong></strong> dalam hal ini bertindak untuk dan atas nama AHMAD SO&rsquo;EM, yang berkedudukan di Dsn. Kunci Rt.006 Rw.002 Pamongan Kecamatan Mojo Kab.Kediri, pribadi untuk selanjutnya disebut sebagai <strong>PIHAK KEDUA</strong>.</li>
                        </ol>
                        </div>
                        <div style="text-align: justify; line-height: 1.5;">PARA PIHAK tetap bertindak sebagaimana tersebut di atas dengan ini menerangkan terlebih dahulu hal-hal sebagai berikut :</div>
                        <div style="line-height: 1.5;">
                        <ul style="text-align: justify;">
                        <li>PIHAK PERTAMA adalah suatu perusahaan, yang berbadan hukum yang berbentuk Perseroan Terbatas yang bergerak di bidang usaha Jasa Akses Internet.</li>
                        <li>PIHAK KEDUA adalah suatu perorangan, yang ditunjuk oleh pihak pertama untuk, mengembangkan bisnis, memperluas jangkauan dan melakukan pekerjaan teknis lainnya di bidang usaha Jasa Akses internet yang masih dibawah kendali PT. Data Buana Nusantara.</li>
                        <li>Bahwa PARA PIHAK dalam hal ini bermaksud melakukan kerjasama.</li>
                        </ul>
                        </div>
                        <div style="text-align: justify; line-height: 1.5;">Atas dasar pertimbangan yang diuraikan tersebut diatas, PARA PIHAK selanjutnya menerangkan dengan ini telah sepakat dan setuju untuk mengadakan Memorandum Of Undertansing / Nota Kesepahaman kerjasama yang saling menguntungkan dengan ketentuan-ketentuan sebagai berikut:&nbsp;</div>
                        <div style="text-align: justify; line-height: 1.5;">&nbsp;</div>
                        <div style="text-align: center; line-height: 1.5;"><strong>PASAL 1&nbsp;</strong></div>
                        <div style="text-align: justify; line-height: 1.5;">Nota Kesepahaman ini adalah sebagai langkah awal dalam rangka usaha kerjasaman yang saling menguntungkan dengan memanfaatkan potensi, keahlian dan fasilitas yang dimiliki masing-masing pihak dalam rangka <strong>Meningkatkan Performance Pendapatan</strong>.&nbsp;</div>
                        <div style="text-align: justify; line-height: 1.5;">&nbsp;</div>
                        <div style="text-align: center; line-height: 1.5;"><strong>PASAL 2&nbsp;</strong></div>
                        <div style="text-align: justify; line-height: 1.5;">Ruang lingkup pekerjaan yang disepakati dalam Nota Kesepahaman ini adalah sebagai berikut :</div>
                        <div style="line-height: 1.5;">
                        <ol>
                        <li style="text-align: justify;">Pihak Kedua yang saat ini memiliki keahlian, modal dan relasi hendak bermitra untuk menjadi reseler dari PT. Data Buana Nusantara dalam mengelola potensi pasar di daerah pada saat ini berkedudukan di Kota Blitar Jawa Timur.</li>
                        <li style="text-align: justify;">Pihak kedua berhak melakukan kegiatan bisnis di bidang ISP (Internet Service Provider) dibawah badan hukum dan atas nama PT. Data Buana Nusantara beserta atributnya dengan sepengetahuan dan ijin dari Pihak Pertama.</li>
                        <li style="text-align: justify;">Pihak kedua wajib melaporkan setiap kegaitan dan transaksi bisnis yang mengatasnamakan PT. Data Buana Nusantara kepada Pihak Pertama.</li>
                        <li style="text-align: justify;">Pihak Kedua akan mengelola secara mandiri kegiatan bisnisnya baik dalam teknis dan penagihan.</li>
                        <li style="text-align: justify;">Pihak Pertama akan mensupport Pihak Kedua baik di bidang administrasi dan teknis sesuai kesepakatan.</li>
                        <li style="text-align: justify;">Pihak Pertama akan mendukung pihak kedua dalam penyediaan marketing tools dan legalitasnya. &nbsp;</li>
                        </ol>
                        </div>
                        <div style="text-align: center; line-height: 1.5;"><strong>PASAL 3 </strong></div>
                        <div style="text-align: justify; line-height: 1.5;">Untuk melaksanakan satuan pekerjaan pada pasal 2 diatas, <strong>PARA PIHAK</strong> akan membuat Perjanjian Kerjasama yang membuat hak dan kewajiban, kedudukan serta peran dan fungsi masing-masing pihak.</div>
                        <div style="text-align: center; line-height: 1.5;">&nbsp;</div>
                        <div style="text-align: center; line-height: 1.5;"><strong>Pasal 3.1&nbsp;</strong></div>
                        <div style="text-align: center; line-height: 1.5;">Hak dan Kewajiban Pihak Pertama&nbsp;</div>
                        <div style="line-height: 1.5;">
                        <ul>
                        <li style="text-align: justify;">
                        <div style="text-align: justify;">Pihak Pertama berkewajiban melakukan kontrol penuh terhadap kinerja baik teknis maupun non teknis yang dilakukan oleh pihak kedua.</div>
                        </li>
                        <li style="text-align: justify;">
                        <div>Pihak Pertama diberi akses untuk membaca router pihak kedua.</div>
                        </li>
                        <li style="text-align: justify;">
                        <div>Pihak Pertama akan menerima semua laporan dari pihak kedua. Adapun laporan yang disampaikan sebagai berikut :&nbsp;</div>
                        </li>
                        </ul>
                        </div>
                        <div style="line-height: 1.5; padding-left: 40px; text-align: justify;">⮚ Laporan Form Berlangganan setiap blan</div>
                        <div style="line-height: 1.5; padding-left: 40px; text-align: justify;">⮚ Laporan administrasi setiap tanggal 30/1 akhir bulan</div>
                        <div style="line-height: 1.5; padding-left: 40px; text-align: justify;">⮚ Laporan data pelanggan setiap bulan</div>
                        <div style="line-height: 1.5;">
                        <ul>
                        <li style="text-align: justify;">
                        <div style="line-height: 1.5;">Pihak Pertama akan mendapatkan hak <strong>4% (didalamnya termasuk komponen BHP, USO )</strong> dari nilai kontrak seluruh pelanggan pihak kedua sebagai royaliti atas pembinaan operasional dalam hal administrasi dan teknis dari pihak kedua.</div>
                        </li>
                        <li style="text-align: justify;">
                        <div>Pihak Pertama wajib menjaga kualitas sambungan yang stabil samapi ke node pihak kedua dan memberitahukan kepada pihak kedua apabila terjadi masalah dengan koneksi.</div>
                        </li>
                        <li style="text-align: justify;">
                        <div>Pihak Pertama wajib menjual jasa akses internet kepada pihak kedua.</div>
                        </li>
                        <li style="text-align: justify;">
                        <div style="text-align: justify;">Segala biaya yang timbul dalam rangka penagihan Invoice seperti : telepon dan materai menjadi tanggung jawab pihak kedua.</div>
                        </li>
                        </ul>
                        </div>
                        <div style="text-align: center; line-height: 1.5;"><strong>Pasal 3.2</strong></div>
                        <div style="line-height: 1.5;">
                        <ul>
                        <li style="text-align: justify;">
                        <div style="text-align: justify;">Pihak kedua berhak untuk menentukan sendiri sistem dan prosedur dalam memasarkan, menangani trouble dan lain-lain tetapi dalam koridor menjaga nama baik dan kordinasi dari pihak pertama.</div>
                        </li>
                        <li style="text-align: justify;">
                        <div>Pihak kedua berhak untuk mendapat support teknis, administrasi dan managerial dari pihak pertama.</div>
                        </li>
                        <li style="text-align: justify;">
                        <div>Pihak kedua berhak mendapat sarana pendukung dalam memasarkan product pihak pertama, mereka akan mendapat contoh proposal, Company Profile, dokumen keabsahan perusahaan dari instansi terkait.</div>
                        </li>
                        <li style="text-align: justify;">
                        <div>Pihak kedua berkewajiban membayar bandwith dan juga biaya lain yang dituangkan dalam Invoice kepada Pihak Pertama setiap bulannya dan pembayaran dilakukan di muka (Prepaid).</div>
                        </li>
                        <li style="text-align: justify;">
                        <div>Pihak kedua berkewajiban menjaga nama baik pihak pertam dengan cara menajaga kinerja operasionalnya, memenuhi segala komitmen yang sudah disepakati dengan pihak pelanggan.</div>
                        </li>
                        <li style="text-align: justify;">
                        <div>Pihak kedua wajib membeli bandwith dari pihak pertama untuk seluruh kebutuhan akses internetnya, tidak diperkenankan menggunakan Vendor lain.</div>
                        </li>
                        <li style="text-align: justify;">
                        <div>Pihak kedua wajib menjaga kualitas sambungan yang stabil dari node pihak kedua kepada pelanggannya.</div>
                        </li>
                        <li style="text-align: justify;">
                        <div>Segala hal menyangkut retribusi : pajak, BHP, USO dan biaya sewa kepada Vendor / NAP wajib disetorkan kepada Pihak pertama.</div>
                        </li>
                        <li style="text-align: justify;">
                        <div>Presntasi untuk retribusi sebagai berikut : PPn 11%.</div>
                        </li>
                        <li style="text-align: justify;">
                        <div>Segala kewajiban kepada Pihak / Vendor lain diselesaikan sendiri oleh pihak kedua dan pihak pertama tidak bertanggung jawab atas segala kerugian yang terjadi.</div>
                        </li>
                        <li style="text-align: justify;">
                        <div>Pihak kedua wajib menggunaan frekuensi yang diijinkan oleh Kominfo dikisaran 2,4 GHz dan 5,7 GHz.</div>
                        </li>
                        <li style="text-align: justify;">
                        <div>Jika terdapati oleh Balmon menggunakan frekuensi diluar yang diinjinkan maka diluar tanggung jawab pihak pertama,</div>
                        </li>
                        <li style="text-align: justify;">
                        <div>Pihak kedua wajib mengirimkan data kepada pihak pertama berupa :</div>
                        </li>
                        <li style="list-style-type: none; text-align: justify;">
                        <div>⮚ KTP Penanggung jawab</div>
                        </li>
                        <li style="list-style-type: none; text-align: justify;">
                        <div>⮚ CV</div>
                        </li>
                        <li style="list-style-type: none; text-align: justify;">
                        <div>⮚ NIB</div>
                        </li>
                        <li style="list-style-type: none; text-align: justify;">
                        <div>⮚ TDP</div>
                        </li>
                        <li style="list-style-type: none; text-align: justify;">
                        <div style="text-align: justify;">⮚ Akta Notaris</div>
                        </li>
                        </ul>
                        </div>
                        <div style="text-align: center; line-height: 1.5;"><strong>PASAL 4 </strong></div>
                        <div style="text-align: center; line-height: 1.5;">Cara Pembayaran</div>
                        <div style="line-height: 1.5; text-align: justify;">Pembayaran dilakukan oleh client pihak kedua kepada pihak pertama atas tagihan bandwith dengan transfer ke rekening pihak pertama. Pembayaran dilakukan paling lambat 5 hari setelah jatuh tempo.</div>
                        <div style="line-height: 1.5;">&nbsp;</div>
                        <div style="text-align: center; line-height: 1.5;"><strong>PASAL 5</strong></div>
                        <div style="text-align: center; line-height: 1.5;">Kepemilikan Aset</div>
                        <div style="text-align: justify; line-height: 1.5;">Seluruh aset berupa perangkat maupun seluruh fasilitas pendukungnya yang diinvestasikan dan digunakan oleh pihak kedua dalam rangka penyelenggaraan jasa internet merupakan milik pihak kedua.</div>
                        <div style="text-align: justify; line-height: 1.5;">&nbsp;</div>
                        <div style="text-align: center; line-height: 1.5;"><strong>PASAL 6</strong></div>
                        <div style="text-align: center; line-height: 1.5;">Lain-lain</div>
                        <div style="line-height: 1.5;">
                        <ul>
                        <li style="text-align: justify;">
                        <div style="text-align: justify;">Jika dalam pelaksanaannya terjadi perselisihan antara pihak pertam dan pihak kedua, dapat diselesaikan secara kekeluargaan berdasarkan prinsip musyawarah untuk mufakat&nbsp;</div>
                        </li>
                        <li style="text-align: justify;">
                        <div>Jika jalan musyawarah untuk mufakat tidak tercapai, maka kedua belah pihak sepakat untuk memilih domisili hukum yang tetap di kantor Panitera Pengadilan Negeri Blitar.&nbsp;</div>
                        </li>
                        <li style="text-align: justify;">
                        <div>Salah satu pihak tidak dapat memenuhi kewajibannya, maka MOU ini tidak berlaku lagi dan pihak kedua kewajiban untuk melunasi semua kewajiban &ndash; kewajiban kepada pihak pertama.&nbsp;</div>
                        </li>
                        <li style="text-align: justify;">
                        <div style="text-align: justify;">Jika dikemudian hari terjadi perselisihan antara pihak kedua dengan pelanggan pihak kedua, maka pihak pertama tidak bertanggung jawab terhadap segala tuntutan yang ditunjukkan kepada pihak kedua dalam hal ini PT DATA BUANA NUSANTARA.</div>
                        </li>
                        </ul>
                        </div>
                        <div style="text-align: justify; line-height: 1.5;">&nbsp;</div>
                        <div style="line-height: 1.5; text-align: center;"><strong>PASAL 8</strong></div>
                        <div style="line-height: 1.5; text-align: center;">Kerahasiaan</div>
                        <div style="text-align: justify; line-height: 1.5;">Para pihak sepakat untuk menjaga Informasi rahasia yang diberikan masing-masing pihak dan menahan diri untuk tidak memberikan, mengulang, menyampaikan dan atau mendistribusikan Informasi Rahasia tersebut. Para pihak sepakat untuk menggunakan informasi rahasia tersebut hanya untuk kepentingan perjanjian ini atau dengan ijin dari pihak pemberi.&nbsp;</div>
                        <div style="text-align: justify; line-height: 1.5;">&nbsp;</div>
                        <div style="line-height: 1.5; text-align: center;"><strong>PASAL 9</strong></div>
                        <div style="line-height: 1.5; text-align: center;">Adendum</div>
                        <div style="line-height: 1.5;">
                        <ul>
                        <li>Hal-hal lain yang belum tercantum dalam MOU ini bisa ditambakan di kemudian hari.</li>
                        </ul>
                        </div>
                        <div style="text-align: justify; line-height: 1.5;">Demikian Memorandum Of Understanding / Nota Kesepahaman ini dibuat rangkap 2 (dua) kesepakatan dan ditandatangani oleh PARA PIHAK dalam keadaan sadar sehat jasmani dan rohani, tanpa ada tekanan pengaruh paksaan dari pihak manapun dengan bermaterai cukup dan berlaku sejak ditanda tangani.</div>
                        <div style="text-align: justify; line-height: 1.5;">&nbsp;</div>
                        <div style="text-align: justify; line-height: 1.5;">
                        <table style="border-collapse: collapse; width: 100%; border-width: 0px; height: 144px;" border="1"><colgroup><col style="width: 49.9301%;"><col style="width: 49.9301%;"></colgroup>
                        <tbody>
                        <tr style="height: 24px;">
                        <td style="border-width: 0px; height: 24px; text-align: center;"><strong>PIHAK PERTAMA</strong></td>
                        <td style="border-width: 0px; height: 24px; text-align: center;"><strong>PIHAK KEDUA</strong></td>
                        </tr>
                        <tr style="height: 96px;">
                        <td style="border-width: 0px; height: 96px;"><img src="C:\Users\USER\Downloads\logo.jpeg" alt=""></td>
                        <td style="border-width: 0px; height: 96px;">
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        </td>
                        </tr>
                        <tr style="height: 24px;">
                        <td style="border-width: 0px; height: 24px; text-align: center;"><strong>MUHAMAD KHOTIB</strong></td>
                        <td style="border-width: 0px; height: 24px; text-align: center;"><strong>AHMAD SO'EM</strong></td>
                        </tr>
                        </tbody>
                        </table>
                        </div>
                    </textarea>
                        <input type="submit" value="Save">
                </form>

                <div id="container">
                @elseif (auth()->guard('mitra')->check())
                    <div style="text-align: center; line-height: 1.5;"><strong>MEMORANDUM OF UNDERSTANDING </strong></div>
                    <div style="text-align: center; line-height: 1.5;"><strong>(NOTA KESEPAKATAN)</strong></div>
                    <div style="text-align: center; line-height: 1.5;">&nbsp;</div>
                    <div style="text-align: center; line-height: 1.5;"><strong>ANTARA </strong></div>
                    <div style="text-align: center; line-height: 1.5;">PT. DATA BUANA
                        NUSANTARA&nbsp;<strong><br>&nbsp;<br></strong></div>
                    <div style="text-align: center; line-height: 1.5;"><strong>DENGAN</strong></div>
                    <div style="text-align: center; line-height: 1.5;"></div>
                    <div style="text-align: center; line-height: 1.5;">&nbsp;</div>
                    <div style="line-height: 1.5; text-align: justify;">Pada Hari ini <strong></strong>, tanggal <strong>
                            bulan </strong> tahun <strong> </strong>bertempat di Blitar, PARA PIHAK yang&nbsp;bertanda
                        tangan dibawah ini :</div>
                    <div style="line-height: 1.5;">
                        <ol style="text-align: justify;">
                            <li style="text-align: justify; line-height: 1.5;"><strong>Muhamad Khotib</strong>, Direktur
                                Utama dalam hal ini bertindak untuk dan atas nama PT. Data Buana Nusantara, yang
                                berkedudukan di Ds Tawangrejo, Kecamatan Wonodadi, Kabupaten Blitar, Jawa Timur, untuk
                                selanjutnya disebut sebagai <strong>PIHAK PERTAMA</strong></li>
                            <li style="text-align: justify; line-height: 1.5;"><strong></strong> dalam hal ini bertindak
                                untuk dan atas nama AHMAD SO&rsquo;EM, yang berkedudukan di Dsn. Kunci Rt.006 Rw.002
                                Pamongan Kecamatan Mojo Kab.Kediri, pribadi untuk selanjutnya disebut sebagai <strong>PIHAK
                                    KEDUA</strong>.</li>
                        </ol>
                    </div>
                    <div style="text-align: justify; line-height: 1.5;">PARA PIHAK tetap bertindak sebagaimana tersebut di
                        atas dengan ini menerangkan terlebih dahulu hal-hal sebagai berikut :</div>
                    <div style="line-height: 1.5;">
                        <ul style="text-align: justify;">
                            <li>PIHAK PERTAMA adalah suatu perusahaan, yang berbadan hukum yang berbentuk Perseroan Terbatas
                                yang bergerak di bidang usaha Jasa Akses Internet.</li>
                            <li>PIHAK KEDUA adalah suatu perorangan, yang ditunjuk oleh pihak pertama untuk, mengembangkan
                                bisnis, memperluas jangkauan dan melakukan pekerjaan teknis lainnya di bidang usaha Jasa
                                Akses internet yang masih dibawah kendali PT. Data Buana Nusantara.</li>
                            <li>Bahwa PARA PIHAK dalam hal ini bermaksud melakukan kerjasama.</li>
                        </ul>
                    </div>
                    <div style="text-align: justify; line-height: 1.5;">Atas dasar pertimbangan yang diuraikan tersebut
                        diatas, PARA PIHAK selanjutnya menerangkan dengan ini telah sepakat dan setuju untuk mengadakan
                        Memorandum Of Undertansing / Nota Kesepahaman kerjasama yang saling menguntungkan dengan
                        ketentuan-ketentuan sebagai berikut:&nbsp;</div>
                    <div style="text-align: justify; line-height: 1.5;">&nbsp;</div>
                    <div style="text-align: center; line-height: 1.5;"><strong>PASAL 1&nbsp;</strong></div>
                    <div style="text-align: justify; line-height: 1.5;">Nota Kesepahaman ini adalah sebagai langkah awal
                        dalam rangka usaha kerjasaman yang saling menguntungkan dengan memanfaatkan potensi, keahlian dan
                        fasilitas yang dimiliki masing-masing pihak dalam rangka <strong>Meningkatkan Performance
                            Pendapatan</strong>.&nbsp;</div>
                    <div style="text-align: justify; line-height: 1.5;">&nbsp;</div>
                    <div style="text-align: center; line-height: 1.5;"><strong>PASAL 2&nbsp;</strong></div>
                    <div style="text-align: justify; line-height: 1.5;">Ruang lingkup pekerjaan yang disepakati dalam Nota
                        Kesepahaman ini adalah sebagai berikut :</div>
                    <div style="line-height: 1.5;">
                        <ol>
                            <li style="text-align: justify;">Pihak Kedua yang saat ini memiliki keahlian, modal dan relasi
                                hendak bermitra untuk menjadi reseler dari PT. Data Buana Nusantara dalam mengelola potensi
                                pasar di daerah pada saat ini berkedudukan di Kota Blitar Jawa Timur.</li>
                            <li style="text-align: justify;">Pihak kedua berhak melakukan kegiatan bisnis di bidang ISP
                                (Internet Service Provider) dibawah badan hukum dan atas nama PT. Data Buana Nusantara
                                beserta atributnya dengan sepengetahuan dan ijin dari Pihak Pertama.</li>
                            <li style="text-align: justify;">Pihak kedua wajib melaporkan setiap kegaitan dan transaksi
                                bisnis yang mengatasnamakan PT. Data Buana Nusantara kepada Pihak Pertama.</li>
                            <li style="text-align: justify;">Pihak Kedua akan mengelola secara mandiri kegiatan bisnisnya
                                baik dalam teknis dan penagihan.</li>
                            <li style="text-align: justify;">Pihak Pertama akan mensupport Pihak Kedua baik di bidang
                                administrasi dan teknis sesuai kesepakatan.</li>
                            <li style="text-align: justify;">Pihak Pertama akan mendukung pihak kedua dalam penyediaan
                                marketing tools dan legalitasnya. &nbsp;</li>
                        </ol>
                    </div>
                    <div style="text-align: center; line-height: 1.5;"><strong>PASAL 3 </strong></div>
                    <div style="text-align: justify; line-height: 1.5;">Untuk melaksanakan satuan pekerjaan pada pasal 2
                        diatas, <strong>PARA PIHAK</strong> akan membuat Perjanjian Kerjasama yang membuat hak dan
                        kewajiban, kedudukan serta peran dan fungsi masing-masing pihak.</div>
                    <div style="text-align: center; line-height: 1.5;">&nbsp;</div>
                    <div style="text-align: center; line-height: 1.5;"><strong>Pasal 3.1&nbsp;</strong></div>
                    <div style="text-align: center; line-height: 1.5;">Hak dan Kewajiban Pihak Pertama&nbsp;</div>
                    <div style="line-height: 1.5;">
                        <ul>
                            <li style="text-align: justify;">
                                <div style="text-align: justify;">Pihak Pertama berkewajiban melakukan kontrol penuh
                                    terhadap kinerja baik teknis maupun non teknis yang dilakukan oleh pihak kedua.</div>
                            </li>
                            <li style="text-align: justify;">
                                <div>Pihak Pertama diberi akses untuk membaca router pihak kedua.</div>
                            </li>
                            <li style="text-align: justify;">
                                <div>Pihak Pertama akan menerima semua laporan dari pihak kedua. Adapun laporan yang
                                    disampaikan sebagai berikut :&nbsp;</div>
                            </li>
                        </ul>
                    </div>
                    <div style="line-height: 1.5; padding-left: 40px; text-align: justify;">⮚ Laporan Form Berlangganan
                        setiap blan</div>
                    <div style="line-height: 1.5; padding-left: 40px; text-align: justify;">⮚ Laporan administrasi setiap
                        tanggal 30/1 akhir bulan</div>
                    <div style="line-height: 1.5; padding-left: 40px; text-align: justify;">⮚ Laporan data pelanggan setiap
                        bulan</div>
                    <div style="line-height: 1.5;">
                        <ul>
                            <li style="text-align: justify;">
                                <div style="line-height: 1.5;">Pihak Pertama akan mendapatkan hak <strong>4% (didalamnya
                                        termasuk komponen BHP, USO )</strong> dari nilai kontrak seluruh pelanggan pihak
                                    kedua sebagai royaliti atas pembinaan operasional dalam hal administrasi dan teknis dari
                                    pihak kedua.</div>
                            </li>
                            <li style="text-align: justify;">
                                <div>Pihak Pertama wajib menjaga kualitas sambungan yang stabil samapi ke node pihak kedua
                                    dan memberitahukan kepada pihak kedua apabila terjadi masalah dengan koneksi.</div>
                            </li>
                            <li style="text-align: justify;">
                                <div>Pihak Pertama wajib menjual jasa akses internet kepada pihak kedua.</div>
                            </li>
                            <li style="text-align: justify;">
                                <div style="text-align: justify;">Segala biaya yang timbul dalam rangka penagihan Invoice
                                    seperti : telepon dan materai menjadi tanggung jawab pihak kedua.</div>
                            </li>
                        </ul>
                    </div>
                    <div style="text-align: center; line-height: 1.5;"><strong>Pasal 3.2</strong></div>
                    <div style="line-height: 1.5;">
                        <ul>
                            <li style="text-align: justify;">
                                <div style="text-align: justify;">Pihak kedua berhak untuk menentukan sendiri sistem dan
                                    prosedur dalam memasarkan, menangani trouble dan lain-lain tetapi dalam koridor menjaga
                                    nama baik dan kordinasi dari pihak pertama.</div>
                            </li>
                            <li style="text-align: justify;">
                                <div>Pihak kedua berhak untuk mendapat support teknis, administrasi dan managerial dari
                                    pihak pertama.</div>
                            </li>
                            <li style="text-align: justify;">
                                <div>Pihak kedua berhak mendapat sarana pendukung dalam memasarkan product pihak pertama,
                                    mereka akan mendapat contoh proposal, Company Profile, dokumen keabsahan perusahaan dari
                                    instansi terkait.</div>
                            </li>
                            <li style="text-align: justify;">
                                <div>Pihak kedua berkewajiban membayar bandwith dan juga biaya lain yang dituangkan dalam
                                    Invoice kepada Pihak Pertama setiap bulannya dan pembayaran dilakukan di muka (Prepaid).
                                </div>
                            </li>
                            <li style="text-align: justify;">
                                <div>Pihak kedua berkewajiban menjaga nama baik pihak pertam dengan cara menajaga kinerja
                                    operasionalnya, memenuhi segala komitmen yang sudah disepakati dengan pihak pelanggan.
                                </div>
                            </li>
                            <li style="text-align: justify;">
                                <div>Pihak kedua wajib membeli bandwith dari pihak pertama untuk seluruh kebutuhan akses
                                    internetnya, tidak diperkenankan menggunakan Vendor lain.</div>
                            </li>
                            <li style="text-align: justify;">
                                <div>Pihak kedua wajib menjaga kualitas sambungan yang stabil dari node pihak kedua kepada
                                    pelanggannya.</div>
                            </li>
                            <li style="text-align: justify;">
                                <div>Segala hal menyangkut retribusi : pajak, BHP, USO dan biaya sewa kepada Vendor / NAP
                                    wajib disetorkan kepada Pihak pertama.</div>
                            </li>
                            <li style="text-align: justify;">
                                <div>Presntasi untuk retribusi sebagai berikut : PPn 11%.</div>
                            </li>
                            <li style="text-align: justify;">
                                <div>Segala kewajiban kepada Pihak / Vendor lain diselesaikan sendiri oleh pihak kedua dan
                                    pihak pertama tidak bertanggung jawab atas segala kerugian yang terjadi.</div>
                            </li>
                            <li style="text-align: justify;">
                                <div>Pihak kedua wajib menggunaan frekuensi yang diijinkan oleh Kominfo dikisaran 2,4 GHz
                                    dan 5,7 GHz.</div>
                            </li>
                            <li style="text-align: justify;">
                                <div>Jika terdapati oleh Balmon menggunakan frekuensi diluar yang diinjinkan maka diluar
                                    tanggung jawab pihak pertama,</div>
                            </li>
                            <li style="text-align: justify;">
                                <div>Pihak kedua wajib mengirimkan data kepada pihak pertama berupa :</div>
                            </li>
                            <li style="list-style-type: none; text-align: justify;">
                                <div>⮚ KTP Penanggung jawab</div>
                            </li>
                            <li style="list-style-type: none; text-align: justify;">
                                <div>⮚ CV</div>
                            </li>
                            <li style="list-style-type: none; text-align: justify;">
                                <div>⮚ NIB</div>
                            </li>
                            <li style="list-style-type: none; text-align: justify;">
                                <div>⮚ TDP</div>
                            </li>
                            <li style="list-style-type: none; text-align: justify;">
                                <div style="text-align: justify;">⮚ Akta Notaris</div>
                            </li>
                        </ul>
                    </div>
                    <div style="text-align: center; line-height: 1.5;"><strong>PASAL 4 </strong></div>
                    <div style="text-align: center; line-height: 1.5;">Cara Pembayaran</div>
                    <div style="line-height: 1.5; text-align: justify;">Pembayaran dilakukan oleh client pihak kedua kepada
                        pihak pertama atas tagihan bandwith dengan transfer ke rekening pihak pertama. Pembayaran dilakukan
                        paling lambat 5 hari setelah jatuh tempo.</div>
                    <div style="line-height: 1.5;">&nbsp;</div>
                    <div style="text-align: center; line-height: 1.5;"><strong>PASAL 5</strong></div>
                    <div style="text-align: center; line-height: 1.5;">Kepemilikan Aset</div>
                    <div style="text-align: justify; line-height: 1.5;">Seluruh aset berupa perangkat maupun seluruh
                        fasilitas pendukungnya yang diinvestasikan dan digunakan oleh pihak kedua dalam rangka
                        penyelenggaraan jasa internet merupakan milik pihak kedua.</div>
                    <div style="text-align: justify; line-height: 1.5;">&nbsp;</div>
                    <div style="text-align: center; line-height: 1.5;"><strong>PASAL 6</strong></div>
                    <div style="text-align: center; line-height: 1.5;">Lain-lain</div>
                    <div style="line-height: 1.5;">
                        <ul>
                            <li style="text-align: justify;">
                                <div style="text-align: justify;">Jika dalam pelaksanaannya terjadi perselisihan antara
                                    pihak pertam dan pihak kedua, dapat diselesaikan secara kekeluargaan berdasarkan prinsip
                                    musyawarah untuk mufakat&nbsp;</div>
                            </li>
                            <li style="text-align: justify;">
                                <div>Jika jalan musyawarah untuk mufakat tidak tercapai, maka kedua belah pihak sepakat
                                    untuk memilih domisili hukum yang tetap di kantor Panitera Pengadilan Negeri
                                    Blitar.&nbsp;</div>
                            </li>
                            <li style="text-align: justify;">
                                <div>Salah satu pihak tidak dapat memenuhi kewajibannya, maka MOU ini tidak berlaku lagi dan
                                    pihak kedua kewajiban untuk melunasi semua kewajiban &ndash; kewajiban kepada pihak
                                    pertama.&nbsp;</div>
                            </li>
                            <li style="text-align: justify;">
                                <div style="text-align: justify;">Jika dikemudian hari terjadi perselisihan antara pihak
                                    kedua dengan pelanggan pihak kedua, maka pihak pertama tidak bertanggung jawab terhadap
                                    segala tuntutan yang ditunjukkan kepada pihak kedua dalam hal ini PT DATA BUANA
                                    NUSANTARA.</div>
                            </li>
                        </ul>
                    </div>
                    <div style="text-align: justify; line-height: 1.5;">&nbsp;</div>
                    <div style="line-height: 1.5; text-align: center;"><strong>PASAL 8</strong></div>
                    <div style="line-height: 1.5; text-align: center;">Kerahasiaan</div>
                    <div style="text-align: justify; line-height: 1.5;">Para pihak sepakat untuk menjaga Informasi rahasia
                        yang diberikan masing-masing pihak dan menahan diri untuk tidak memberikan, mengulang, menyampaikan
                        dan atau mendistribusikan Informasi Rahasia tersebut. Para pihak sepakat untuk menggunakan informasi
                        rahasia tersebut hanya untuk kepentingan perjanjian ini atau dengan ijin dari pihak pemberi.&nbsp;
                    </div>
                    <div style="text-align: justify; line-height: 1.5;">&nbsp;</div>
                    <div style="line-height: 1.5; text-align: center;"><strong>PASAL 9</strong></div>
                    <div style="line-height: 1.5; text-align: center;">Adendum</div>
                    <div style="line-height: 1.5;">
                        <ul>
                            <li>Hal-hal lain yang belum tercantum dalam MOU ini bisa ditambakan di kemudian hari.</li>
                        </ul>
                    </div>
                    <div style="text-align: justify; line-height: 1.5;">Demikian Memorandum Of Understanding / Nota
                        Kesepahaman ini dibuat rangkap 2 (dua) kesepakatan dan ditandatangani oleh PARA PIHAK dalam keadaan
                        sadar sehat jasmani dan rohani, tanpa ada tekanan pengaruh paksaan dari pihak manapun dengan
                        bermaterai cukup dan berlaku sejak ditanda tangani.</div>
                    <div style="text-align: justify; line-height: 1.5;">&nbsp;</div>
                    <div style="text-align: justify; line-height: 1.5;">
                        <table style="border-collapse: collapse; width: 100%; border-width: 0px; height: 144px;"
                            border="1">
                            <colgroup>
                                <col style="width: 49.9301%;">
                                <col style="width: 49.9301%;">
                            </colgroup>
                            <tbody>
                                <tr style="height: 24px;">
                                    <td style="border-width: 0px; height: 24px; text-align: center;"><strong>PIHAK
                                            PERTAMA</strong></td>
                                    <td style="border-width: 0px; height: 24px; text-align: center;"><strong>PIHAK
                                            KEDUA</strong></td>
                                </tr>
                                <tr style="height: 96px;">
                                    <td style="border-width: 0px; height: 96px;"><img
                                            src="C:\Users\USER\Downloads\logo.jpeg" alt=""></td>
                                    <td style="border-width: 0px; height: 96px;">
                                        <p>&nbsp;</p>
                                        <p>&nbsp;</p>
                                    </td>
                                </tr>
                                <tr style="height: 24px;">
                                    <td style="border-width: 0px; height: 24px; text-align: center;"><strong>MUHAMAD
                                            KHOTIB</strong></td>
                                    <td style="border-width: 0px; height: 24px; text-align: center;"><strong>AHMAD
                                            SO'EM</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-12 d-grid gap-2 d-md-flex justify-content-md-end">
        <button id="print-button" class="btn btn-warning btn-icon-text">
            Print
            <i class="ti-printer btn-icon-append"></i>
        </button>
    </div><br>
    @push('page-script')
        <script>
            tinymce.init({
                selector: '#myTextarea',
                line_height_formats: '0.5 1 1.2 1.4 1.5 2',
                plugins: [
                    'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'prewiew', 'anchor',
                    'pagebreak',
                    'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime',
                    'media',
                    'table', 'emoticons', 'template', 'codesample'
                ],
                toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify |' +
                    'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
                    'forecolor backcolor emoticons',
                menubar: 'favs file edit view insert format tools table',
                content_style: 'body{font-family:Helvetica,Arial,sans-serif; font-size:12px, line-height: 1.5}',
            });
        </script>
        <style>
            @page {
                margin: 5cm;
                size: A4;
            }
        </style>
        <script>
            $("#print-button").click(function() {
                var divToPrint = document.getElementById('container');
                var htmlToPrint = '' +
                    '<style type="text/css">' +
                    'table th, table td {' +
                    'border:1px solid #000;' +
                    'padding:0.5em;' +
                    '}' +
                    '@page {' +
                    'margin: 2cm;' +
                    'size: A4;' +
                    '}' +
                    '</style>';
                htmlToPrint += divToPrint.outerHTML;
                newWin = window.open("");
                newWin.document.write(htmlToPrint);
                newWin.print();
                newWin.close();
            });
        </script>
        <script>
            $(document).ready(function() {

                $("#save").submit(function(e) {

                    var content = tinymce.get("myTextarea").getContent();

                    $("#container").html(content);

                    return false;
                })
            })
        </script>
    @endpush
@endsection
