window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki


    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }

    const dtRegisteredUsers = document.getElementById("datatablesRegisteredUsers");

    if (dtRegisteredUsers) {
        new simpleDatatables.DataTable(dtRegisteredUsers);

        dtRegisteredUsers.querySelector("tbody").addEventListener("click", function (event) {
            let button = event.target.closest(".toggle-btn");
            if (!button) return;

            let row          = button.closest("tr");
            let referralCode = row.querySelector("td:last-child").textContent.trim();
            let icon         = button.querySelector("svg");

            // Cek apakah detail row sudah ada
            let nextRow = row.nextElementSibling;
            if (nextRow && nextRow.classList.contains("detail-row")) {
                nextRow.remove(); // Hapus jika sudah ada
                icon.setAttribute("data-icon", "circle-plus");
                return;
            }

            // Fetch data dari server
            fetch(`/registered-users/details/${referralCode}`)
                .then(response => response.json())
                .then(data => {
                    let detailRow = document.createElement("tr");
                    detailRow.classList.add("detail-row");

                    let tableContent = data.length > 0 
                        ? data.map(item => `
                            <tr>
                                <td>${item.level}</td>
                                <td>${item.jumlah_user}</td>
                                <td>Rp ${(item.jumlah_user * 1000).toLocaleString('id-ID')}</td> <!-- Perkalian 1000 -->
                            </tr>
                        `).join('')
                        : `<tr><td colspan="5" class="text-center text-muted">Tidak ada data tersedia</td></tr>`;

                    detailRow.innerHTML = `
                        <td colspan="6">
                            <div class="p-3 bg-light border rounded">
                                <table class="table table-sm table-bordered mt-2">
                                    <thead class="bg-primary text-white text-center border-2">
                                        <tr>
                                            <th>Level</th>
                                            <th>Jumlah User</th>
                                            <th>Pendapatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>${tableContent}</tbody>
                                </table>
                            </div>
                        </td>
                    `;

                    // Sisipkan setelah row utama
                    row.parentNode.insertBefore(detailRow, row.nextSibling);

                    // Ubah ikon menjadi minus
                    icon.setAttribute("data-icon", "circle-minus");
                })
                .catch(error => console.error("Error fetching data:", error));
        });
    }





});
