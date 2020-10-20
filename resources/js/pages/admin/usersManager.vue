<template>
<div >
    <p>quang co len!</p>
</div>
</template>

<script>
export default {
    props: {
      auth: {
        type: Object
      }
    },

    data() {
        return {
            url: '',
        }
    },

    created() {
        this.readOnline();
    },

    methods: {
        readOnline(){
            // axios.get('/readOnline', {
            //     params: {
            //         id: this.bookId,
            //     },
            // })
            // .then(response => {
            //     console.log(response.data);
            //     this.url = response.data[0].fileName;
            // })
            // .catch(function (error) {
            //     console.log(error);
            // });
        },
    }
}
</script>
<style lang="scss" scoped >
    .row {
        height: 1000px;
    }
</style>
