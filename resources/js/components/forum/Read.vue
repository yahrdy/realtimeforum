<template>
    <div v-if="question">
        <edit-question
                v-if="editing"
                :question=question
        ></edit-question>
            <show-question
                    :question = question
                    v-else
            ></show-question>
        <v-container>
            <replies :question="question"></replies>
            <new-reply :questionSlug="question.slug"></new-reply>
        </v-container>
    </div>
</template>

<script>
    import ShowQuestion from './ShowQuestion';
    import EditQuestion from './EditQuestion.vue';
    import Replies from '../reply/Replies';
    import NewReply from '../reply/NewReply';
    export default {
        components:{ShowQuestion,EditQuestion,Replies,NewReply},
        data(){
            return {
                question: null,
                editing: false,
            }
        },
        created(){

            this.listen();
            this.getQuestion();

        },
        methods:{
            listen(){
                EventBus.$on('startEditing',()=>{
                    this.editing = true;
                });

                EventBus.$on('cancelEditing',()=>{
                    this.editing = false;
                })
            },
            getQuestion(){
                axios.get(`/api/question/${this.$route.params.slug}`)
                    .then(res => this.question = res.data.data)
            }
        }
    }
</script>