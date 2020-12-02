<template>
<div class="container content-container">
    <ul class="center-block row table-item">
        <li class="cat-item col-xs-12 col-md-4 col-sm-6"
            v-for="(category, index) in categories"
            :key="index"
        >
            <router-link :to="{name:'category', params: { id: category.id } }">
                <a-button>
                    <span class="glyphicon glyphicon-folder-open"></span>
                    {{category.name}}
                </a-button>
            </router-link>

        </li>
    </ul>
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
            categories:[],
        }
    },

    created() {
        this.getListCategories();
        console.log('auth' + this.auth);
    },
    methods: {
        getListCategories(){
            axios.get('/allCategories')
            .then(response => {
                console.log(response.data);
                this.categories = response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    }
}
</script>
<style lang="scss" scoped>
    .table-item {
        height: 400px;
        overflow-y: scroll;
    }
    @media screen and (min-width: 1400px) {
        .table-item {
            height: 700px;
        }
    }
    .cat-item {
        list-style-type: none;
    }
    .cat-item {
        padding: 10px 10px;
    }
    .glyphicon {
        padding-right: 10px;
    }
</style>
