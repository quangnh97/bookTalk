<template>
    <div >
        <div class="head-ps">QUẢN LÍ THỂ LOẠI</div>
        <div class="table-item ">
            <table class="table table-bordered">
                <tr class="row-text">
                    <th>Id</th>
                    <th>Tên thể loại</th>
                    <th class="active">
                        <button
                            type="button"
                            class="btn add"
                            @click="showModalCreateCategory()"
                        >
                            <i class="fas fa-plus" />

                        </button>
                    </th>
                </tr>
                <tr v-for="category in categories" :key="category.id">
                    <td class="color-column">
                        {{ category.id }}
                    </td>
                    <td class="status-column">{{ category.name }}</td>
                    <td class="active">
                        <button
                            class="btn edit"
                            @click="showModalEditCategory(category.id)"
                        >
                            <i class="fas fa-pencil-alt" />
                        </button>
                        <button
                            type="button"
                            class="btn delete"
                            data-toggle="modal"
                            data-target="#deleteStatus"
                            @click="showModalDeleteCategory(category.id)"
                        >
                            <i class="fas fa-eraser" />
                        </button>
                    </td>
                </tr>
            </table>
<!--            <div v-if="numberPage>=2" class="overflow-auto">-->
<!--                <paginate-->
<!--                    v-model="pageNum"-->
<!--                    :page-count="numberPage"-->
<!--                    :page-range="3"-->
<!--                    :margin-pages="2"-->
<!--                    :click-handler="paginateFreeItem"-->
<!--                    :prev-text="$t('index.prev')"-->
<!--                    :next-text=" $t('index.nextPaginate')"-->
<!--                    :container-class="'pagination'"-->
<!--                    :page-class="'page-item'"-->
<!--                    :prev-class="'page-item'"-->
<!--                    :next-class="'page-item'"-->
<!--                    :page-link-class="'page-link-item'"-->
<!--                    :prev-link-class="'page-link-item'"-->
<!--                    :next-link-class="'page-link-item'"-->
<!--                    :active-class="'active-class'"-->
<!--                    :hide-prev-next="true"-->
<!--                />-->
<!--            </div>-->
        </div>
    </div>
</template>
<script>
    import { mapActions, mapGetters } from 'vuex';
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
        },
        methods: {
            ...mapActions({
                showModalCreateCategory: 'modals/showModalCreateCategory',
            }),

            getListCategories(){
                axios.get('/categories')
                    .then(response => {
                        console.log(response.data);
                        this.categories = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            showModalEditCategory(){

            },

            showModalDeleteCategory(){

            }
        }
    }
</script>
<style lang="scss" scoped >
    .row {
        height: 1000px;
    }
    .head-ps {
        background-color: #fee67a;
        height: 4%;
        margin-bottom: 20px;
        padding-left: 2%;
        padding-top: .7%;
        padding-bottom: .7%;
        color: #636b6f;
        font-weight: 700;
        font-size: 18px;
    }

    .table-item {
        height: auto;
        margin-bottom: 2%;
    }
    .header {
        background-color: #fee67a;
        height: 4%;
        padding-left: 2%;
        padding-top: 0.7%;
        color: #FD8400;
        font-weight: bold;
    }
    .label {
        margin: 2% 0 0.5% 5.5%;
    }
    th, td {
        border: 1px solid #dee2e6;
    }
    .table td, .table th {
        padding: .75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .table-bordered {
        height: auto;
        width: 96%;
        max-width: 1300px;
        background-color: #ffffff;
        margin: 0 2%;
        .color-column {
            width: 5%;
            text-align: center;
            .status-color {
                background-color: #3f9ae5;
                width: 227px;
                height: 37px;
            }
        }
        .status-column {
            width: 75%;
            text-align: left;
            padding: 2.2% 0 0 3%;;
        }
        .row-text {
            th {
                text-align: center !important;
            }
            text-align: center;
        }
        .active {
            .add {
                background-color: #3fe576;
            }
            .edit {
                background-color: #efefef;
                margin-left: 15%;
            }
            .delete {
                margin-left: 10%;
                background-color: #ff8400;
            }
        }
    }
</style>
