<script>
    importData();
    async function importData() {

        let url = "{{route('get.user.mahasiswa')}}"
        // url = url.replace(':periode', periode.value)
        let send = await fetch(url)
        let response = await send.json()

        let dataId = []
        let dataUser = response;
        dataUser.forEach(function(data) {
            dataId.push(data.name);
        });
        console.log(dataId);
        dataSend = new FormData()
        dataSend.append('iddata', JSON.stringify(dataId))
        // dataSend.append('where', JSON.stringify(dataWhere))
        response = await fetch('https://sia.iainkendari.ac.id/get-id-data', {
            method: "POST",
            body: dataSend
        })
        responseMessage = await response.json()
        console.log(responseMessage);
        // return;
        responseMessage.data.map(async function(data, index) {
            // if (index <= 1) {

            let dataSend = new FormData()
            dataSend.append('data', JSON.stringify(data))
            let sendUser = await fetch("{{route('import.store')}}", {
                method: "POST",
                body: dataSend
            });
            let responseUser = await sendUser.json()
            console.log(responseUser);
            // }
        })
    }
</script>