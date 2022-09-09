<template>
    <v-app id="inspire" dark>
        <v-navigation-drawer
            v-model="drawer"
            clipped
            fixed
            app
        >
            <v-list dense>
                <v-list-tile exact to="/admin">
                    <v-list-tile-action>
                        <v-icon>dashboard</v-icon>
                    </v-list-tile-action>
                    <v-list-content>
                        <v-list-tile-title>Dashboard</v-list-tile-title>
                    </v-list-content>
                </v-list-tile>

                <v-list-group
                    v-if="$auth.can('view-usermanagement')"
                    no-action
                >
                    <v-list-tile slot="activator">
                        <v-list-tile-action>
                            <v-icon>account_circle</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>User Management</v-list-tile-title> 
                        </v-list-tile-content>
                    </v-list-tile>

                    <v-list-tile to="/admin/users">
                        <v-list-tile-action>
                            <v-icon>account_circle</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>Users</v-list-tile-title> 
                        </v-list-tile-content>
                    </v-list-tile>
                    
                    <v-list-tile to="/admin/roles">
                        <v-list-tile-action>
                            <v-icon>account_circle</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>Roles</v-list-tile-title> 
                        </v-list-tile-content>
                    </v-list-tile>

                    <v-list-tile to="/admin/permissions">
                        <v-list-tile-action>
                            <v-icon>account_circle</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>Permissions</v-list-tile-title> 
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list-group>

                <v-list-tile to="/admin/settings">
                    <v-list-tile-action>
                        <v-icon>setting</v-icon>
                    </v-list-tile-action>
                    <v-list-content>
                        <v-list-tile-title>Settings</v-list-tile-title>
                    </v-list-content>
                </v-list-tile>

            </v-list>

        </v-navigation-drawer>
        <v-toolbar app fixed clipped left>
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-ttile>Laravel Vue Admin</v-toolbar-ttile>
            <v-spacer></v-spacer>

            <v-menu offset-y origin="center center" class="elevation-1" :nudge-bottom="14" transition="scale-transition">
                <v-btn @click="" icon flat slot="activator">
                    <v-badge color="red" overlap>
                        <span slot="badge">{{unreadNotifications.length}}</span>
                        <v-icon medium>notifications</v-icon>
                    </v-badge>
                </v-btn>
                <v-list>
                    <v-list-tile @click="" v-for="notification in allNotifications" :key="notification.id">
                        <v-list-tile-content>
                            <v-list-tile-tile>{{notification.data.createdUser.name}} has just registered</v-list-tile-tile>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list>
            </v-menu>
        </v-toolbar>
        <v-content>
            <v-container fluid fill-height>
                <v-layout justify-center align-center>
                    <v-flex shirnk>
                        <router-view></router-view>b
                        <v-tooltip right>
                            <v-btn
                                slot="activator"
                                :href="source"
                                icon
                                large
                                tager="_blank"
                            >
                                <v-icon large>code</v-icon>
                            </v-btn>
                            <span>Source</span>
                        </v-tooltip>
                        <v-tooltip right>
                            <v-btn slot="activator" icon large href="https://codepen.io/johnjleider/pen/qxQWda" target="_blank">
                                <v-icon large>mdi-codepen</v-icon>
                            </v-btn>
                            <span>Codepen</span>
                        </v-tooltip>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
        <v-footer app fixed>
            <span>&copy; 2017</span>
        </v-footer>
    </v-app>
</template>

<script>
import axios from 'axios';

    export default {
        data: () => ({
            drawer: null,
            allNotifications:[]
        }),
        props: ['user'],

        methods:{
            logout(){
                axios.post('/logout').then(response=>window.location.reload());
            },

            markAsRead(){
                axios.get('/mark-all-read/'+this.user.id).then(response=>{
                    this.unreadNotifications=[];
                });
            }
        },
        
        computed:{
            unreadNotifications(){
                return this.allNotifications.filter(notification=>{
                    return notification.read_at == null;
                })
            }
        },

        created(){
            this.allNotifications=window.SubtleCrypto.user.notifications;

            Echo.private('App.User'+ this.user.id).notification((notification)=>{
                
                this.allNotifications.push(notification.notification);
            });
        }
    };
</script>