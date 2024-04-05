document
    .getElementById("nikForm")
    .addEventListener("submit", async function (e) {
        e.preventDefault();
        const nik = document.getElementById("nikInput").value;
        const resultContainer = document.getElementById("resultContainer");
        const loadingIndicator = document.getElementById("loadingIndicator");
        try {
            loadingIndicator.style.display = "block";
            loadingIndicator.style.textAlign = "center";
            resultContainer.innerHTML = "";
            const response = await fetch(
                `https://indonesian-identification-card-ktp.p.rapidapi.com/api/v3/check?nik=${nik}`,
                {
                    method: "GET",
                    headers: {
                        "X-RapidAPI-Key":
                            "9d5750bfe3msha04b21b567527c3p17e303jsn55dfd97473a4",
                        "X-RapidAPI-Host":
                            "indonesian-identification-card-ktp.p.rapidapi.com",
                    },
                }
            );
            const data = await response.json();
            if (data.success) {
                const results = data.results.realtime_data.findNikSidalih;
                const parseData = data.results.parse_data;
                resultContainer.innerHTML = `
                <h3>Informasi NIK</h3>
                <p><strong>Nama:</strong> ${results.nama}</p>
                <p><strong>NIK:</strong> ${parseData.nik}</p>
                <p><strong>NKK:</strong> ${results.nkk}</p>
                <p><strong>Usia:</strong> ${parseData.usiaValue.tahun} tahun</p>
                <p><strong>Tanggal Lahir:</strong> ${parseData.tanggal_lahir}</p>
                <p><strong>Jenis Kelamin:</strong> ${parseData.jenis_kelamin}</p>
                <p><strong>Kode Pos:</strong> ${parseData.kodepos}</p>
                <p><strong>Provinsi:</strong> ${parseData.provinsi}</p>
                <p><strong>Kabupaten:</strong> ${results.kabupaten}</p>
                <p><strong>Kecamatan:</strong> ${results.kecamatan}</p>
                <p><strong>Kelurahan:</strong> ${results.kelurahan}</p>
            `;
            } else {
                resultContainer.innerHTML = `<p>Fetch data error atau NIK tidak ditemukan: ${nik}</p>`;
            }
        } catch (error) {
            console.error("Error:", error);
        } finally {
            loadingIndicator.style.display = "none";
        }
    });
