<template>
    <div class="container" id="app">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1>Ajouter une commande(s)</h1>
        </div>
        <div class="">
            <div class="col-md-10"></div>
            <div class="col-md-2 float-right mb-2">
                <input type="button" class="btn btn-success" v-on:click="addnewcomande" value="More article">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            // console.log('ADD COMMANDE')
        }
    }
</script>
