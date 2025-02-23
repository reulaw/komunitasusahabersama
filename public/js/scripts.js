/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 
function setModalData(id, user_id, bank_name, acc_number, acc_name, pendapatan_mengendap){
    document.getElementById('modalId').value                        = id;
    document.getElementById('modalUserId').value                    = user_id;
    document.getElementById('hiddenBankName').value                 = bank_name;
    document.getElementById('hiddenNoRek').value                    = acc_number;
    document.getElementById('hiddenRekName').value                  = acc_name;

    document.getElementById('modalBankName').innerText              = bank_name;
    document.getElementById('modalNoRek').innerText                 = acc_number;
    document.getElementById('modalRekName').innerText               = acc_name;
    document.getElementById('modalPendapatanMengendap').innerText   = "Rp" + pendapatan_mengendap;
    // document.getElementById('modalAmount').innerText                ="";

    const amountInput = document.getElementById("modalAmount");
    if (amountInput) {
        amountInput.value = "";
        amountInput.dataset.rawValue = ""; // Pastikan nilai mentah juga dikosongkan
    }

    // console.log("User ID yang dikirim ke form:", user_id);
}


window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }
    
    const amountInput = document.getElementById("modalAmount");

    if (amountInput) {
        amountInput.addEventListener("input", function (event) {
            let value = event.target.value.replace(/[^0-9]/g, ""); // Hanya angka
            if (value) {
                event.target.value = new Intl.NumberFormat("id-ID").format(value);
            }
        });
    }


});
