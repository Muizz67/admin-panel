<template>
    <v-layout row fill-height justify-space-around>
        <v-flex ml-3>
            <v-card>
                <v-card-title primary-title>
                    <div>
                        <h3 class="text-sm-center">Activities</h3>
                        <v-timeline>
                            <v-timeline-item
                                v-for="(activity, i) in activities"
                                :key="i"
                                small
                            >
                                <template v-slot="opposite">
                                    <span v-text="year.year"></span>
                                </template>
                                <div class="py-3">
                                    <div>
                                        {{activity.causer.name}} {{activity.description}} {{activity.subject_type}}
                                    </div>
                                </div>
                            </v-timeline-item>
                        </v-timeline>
                    </div>
                </v-card-title>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
    import axios from 'axios';

    export default{
        data: ()=>({
            activities: []
        }),

        created(){
            axios.get('/api/activities').then(response => {
                this.activities = response.data;
            })
        }
    }
</script>
