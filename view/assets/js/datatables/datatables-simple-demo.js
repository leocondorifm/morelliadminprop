window.addEventListener('DOMContentLoaded', event => {
    console.log('datatablesSimple__s');
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        console.log('datatablesSimple');

        new simpleDatatables.DataTable(datatablesSimple);
    }
});
