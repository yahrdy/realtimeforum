<template>
    <div class="mt-4">
        <v-card>
            <v-card-title>
                <div class="headline">{{ data.user }}</div>
                <div class="ml-2">{{ data.created_at }}</div>
                <v-spacer>
                    <like></like>
                </v-spacer>
            </v-card-title>
            <v-divider></v-divider>

            <edit-reply
                    v-if="editing"
                    :reply = data
            ></edit-reply>

            <v-card-text v-else v-html="reply"></v-card-text>

            <v-divider></v-divider>

            <div v-if="!editing">
                <v-card-actions v-if="own">
                    <v-btn icon small>
                        <v-icon color="orange" @click="edit">edit</v-icon>
                    </v-btn>
                    <v-btn icon small>
                        <v-icon color="red" @click="destroy">delete</v-icon>
                    </v-btn>
                </v-card-actions>
            </div>
        </v-card>
    </div>
</template>
<script>
    import md from 'marked';
    import EditReply from './EditReply';
    import Like from '../like/like';
    export default {
        props: ['data','index'],
        components:{EditReply,Like},
        data(){
            return {
                editing:false,
            }
        },
        computed:{
            own(){
                return User.own(this.data.user_id)
            },
            reply(){
                return md.parse(this.data.reply)
            }
        },
        created(){
            this.listen();
        },
        methods:{
            destroy(){
                EventBus.$emit('destroyReply',this.index)
            },
            edit(){
                this.editing = true;
            },
            listen(){
                EventBus.$on('cancelEditing',() =>{
                    this.editing = false;
                })
            }
        }
    }
</script>