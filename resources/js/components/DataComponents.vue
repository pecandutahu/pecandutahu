<template>
    
    <div class="container">
    <h2>Data Corona Indonesia</h2>
    <p>Data yang terkonfirmasi di Dunia {{data.id}}</p>            
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>John</td>
            <td>Doe</td>
            <td>john@example.com</td>
        </tr>
        <tr>
            <td>Mary</td>
            <td>Moe</td>
            <td>mary@example.com</td>
        </tr>
        <tr>
            <td>July</td>
            <td>Dooley</td>
            <td>july@example.com</td>
        </tr>
        </tbody>
    </table>
    </div>
</template>

<script>
    console.log('aaa');
     export default {

        data() {
            return {
              data: {},
            }
        },
        methods: {
            getData(){
                axios.get('https://bing.com/covid/data')
                     .then((response)=>{
                       this.data = response.data
                     })]
                console.log(response.data);
            }
        },
        created() {
            this.getData()
        }
    }
</script