<template>
    <!-- {{-- search --}} -->
    <div class="top-left links search" style=" width: 300px;">
        <input type="text" class="form-control" placeholder="what are you looking for?"
        v-model="qry" v-on:keyup="autoComplete" />

        <div class="panel-footer" v-if="results.length >= 0"
        style="position:relative; z-index:1000; border:1px solid #ccc; background:#fff; padding: 0px 15px;">
        <p v-for="result in results">
            <!-- <a :href="'{{url('profile')}}/' +  result.slug"> -->
            <router-link :to="'/profile/' + result.slug"><b v-on:click="results=[]">{{result.name}} </b></router-link>
        </p>
        </div>
    </div>
</template>

<script>
  export default {
    data() {
        return {
            qry:'',
            results: [],
        }
    },
    methods: {

        // clickHandler () {
        //     console.log("You clicked the button!");
        // },

        autoComplete() {
            this.results=[];
            // console.log(this.qry);
            axios.post('/search', { qry: this.qry }
            ).then( (response) => {
                // console.log(response);
                this.results = response.data;
                console.log(this.results);
            });
        },
    },
  }
</script>
