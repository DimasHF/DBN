@push('page-script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const urlParams = new URLSearchParams(window.location.search);
        const latitude = urlParams.get('latitude');
        const longitude = urlParams.get('longitude');

        // Isi input field dengan nilai yang diterima
        document.getElementById("latitude").value = latitude || document.getElementById("latitude").value;
        document.getElementById("longitude").value = longitude || document.getElementById("longitude").value;
    });
</script>

<script>
    // Mendefinisikan elemen-elemen dropdown
    const provinsiDropdown = document.getElementById('provinsi');
    const kabupatenDropdown = document.getElementById('kota/kab');
    const kecamatanDropdown = document.getElementById('kecamatan');
    const kelurahanDropdown = document.getElementById('kelurahan');

    // Kode JavaScript untuk mengisi dropdown provinsi
    fetch(`https://mitsafata.github.io/api-wilayah-indonesia/api/provinces.json`)
        .then(response => response.json())
        .then(provinces => {
            provinsiDropdown.innerHTML = '<option value="">Pilih Provinsi</option>';
            provinces.forEach(provinsi => {
                provinsiDropdown.innerHTML += `<option data-dist="${provinsi.id}" value="${provinsi.name}">${provinsi.name}</option>`;
            });
        });

    // Event listener untuk mengisi dropdown kabupaten/kota saat provinsi dipilih
    provinsiDropdown.addEventListener('change', function() {
        const selectedProvinsiOption = provinsiDropdown.options[provinsiDropdown.selectedIndex];
        const selectedProvinsiId = selectedProvinsiOption.getAttribute('data-dist');
        console.log(selectedProvinsiId);
        if (selectedProvinsiId !== '') {
            // Mengosongkan dropdown yang lebih rendah jika provinsi berubah
            kabupatenDropdown.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
            kecamatanDropdown.innerHTML = '<option value="">Pilih Kecamatan</option>';
            kelurahanDropdown.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

            // Mengambil data kabupaten/kota berdasarkan provinsi yang dipilih
            fetch(`https://mitsafata.github.io/api-wilayah-indonesia/api/regencies/${selectedProvinsiId}.json`)
                .then(response => response.json())
                .then(regencies => {
                    kabupatenDropdown.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                    regencies.forEach(regency => {
                        kabupatenDropdown.innerHTML +=
                            `<option data-dist="${regency.id}" value="${regency.name}">${regency.name}</option>`;
                    });
                });
        }
    });

    // Event listener untuk mengisi dropdown kecamatan saat kabupaten/kota dipilih
    kabupatenDropdown.addEventListener('change', function() {
        const selectedKabOption = kabupatenDropdown.options[kabupatenDropdown.selectedIndex];
        const selectedKabupatenId = selectedKabOption.getAttribute('data-dist');
        if (selectedKabupatenId !== '') {
            // Mengosongkan dropdown yang lebih rendah jika kabupaten/kota berubah
            kecamatanDropdown.innerHTML = '<option value="">Pilih Kecamatan</option>';
            kelurahanDropdown.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

            // Mengambil data kecamatan berdasarkan kabupaten/kota yang dipilih
            fetch(`https://mitsafata.github.io/api-wilayah-indonesia/api/districts/${selectedKabupatenId}.json`)
                .then(response => response.json())
                .then(districts => {
                    kecamatanDropdown.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    districts.forEach(district => {
                        kecamatanDropdown.innerHTML +=
                            `<option data-dist="${district.id}" value="${district.name}">${district.name}</option>`;
                    });
                });
        }
    });

    // Event listener untuk mengisi dropdown kelurahan saat kecamatan dipilih
    kecamatanDropdown.addEventListener('change', function() {
        const selectedKecOption = kecamatanDropdown.options[kecamatanDropdown.selectedIndex];
        const selectedKecamatanId = selectedKecOption.getAttribute('data-dist');
        if (selectedKecamatanId !== '') {
            // Mengosongkan dropdown yang lebih rendah jika kecamatan berubah
            kelurahanDropdown.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

            // Mengambil data kelurahan/desa berdasarkan kecamatan yang dipilih
            fetch(`https://mitsafata.github.io/api-wilayah-indonesia/api/villages/${selectedKecamatanId}.json`)
                .then(response => response.json())
                .then(villages => {
                    kelurahanDropdown.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                    villages.forEach(village => {
                        kelurahanDropdown.innerHTML +=
                            `<option data-dist="${village.id}" value="${village.name}">${village.name}</option>`;
                    });
                });
        }
    });

</script>
@endpush