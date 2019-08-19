<template>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5>Exception Logs</h5>
        </div>


        <div v-if="!ready" class="d-flex align-items-center justify-content-center card-bg-secondary p-5 bottom-radius">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="icon spin mr-2 fill-text-color">
                <path d="M12 10a2 2 0 0 1-3.41 1.41A2 2 0 0 1 10 8V0a9.97 9.97 0 0 1 10 10h-8zm7.9 1.41A10 10 0 1 1 8.59.1v2.03a8 8 0 1 0 9.29 9.29h2.02zm-4.07 0a6 6 0 1 1-7.25-7.25v2.1a3.99 3.99 0 0 0-1.4 6.57 4 4 0 0 0 6.56-1.42h2.1z"></path>
            </svg>

            <span>Scanning...</span>
        </div>


        <div v-if="ready && entries.length == 0" class="d-flex flex-column align-items-center justify-content-center card-bg-secondary p-5 bottom-radius">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60" class="fill-text-color" style="width: 200px;">
                <path fill-rule="evenodd" d="M7 10h41a11 11 0 0 1 0 22h-8a3 3 0 0 0 0 6h6a6 6 0 1 1 0 12H10a4 4 0 1 1 0-8h2a2 2 0 1 0 0-4H7a5 5 0 0 1 0-10h3a3 3 0 0 0 0-6H7a6 6 0 1 1 0-12zm14 19a1 1 0 0 1-1-1 1 1 0 0 0-2 0 1 1 0 0 1-1 1 1 1 0 0 0 0 2 1 1 0 0 1 1 1 1 1 0 0 0 2 0 1 1 0 0 1 1-1 1 1 0 0 0 0-2zm-5.5-11a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm24 10a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm1 18a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm-14-3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm22-23a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM33 18a1 1 0 0 1-1-1v-1a1 1 0 0 0-2 0v1a1 1 0 0 1-1 1h-1a1 1 0 0 0 0 2h1a1 1 0 0 1 1 1v1a1 1 0 0 0 2 0v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 0-2h-1z"></path>
            </svg>

            <span>We didn't find anything - just empty space.</span>
        </div>


        <table id="indexScreen" class="table table-hover table-sm mb-0 penultimate-column-right" v-if="ready && entries.length > 0">
            <thead>
                <tr slot="table-header">
                    <th scope="col">Type</th>
                    <th scope="col">Occurrences</th>
                    <th scope="col">Happened</th>
                    <th scope="col"></th>
                </tr>
            </thead>


            <transition-group tag="tbody" name="list">
                <tr v-if="hasNewEntries" key="newEntries" class="dontanimate">
                    <td colspan="100" class="text-center card-bg-secondary py-1">
                        <small><a href="#" v-on:click.prevent="loadNewEntries" v-if="!loadingNewEntries">Load New Entries</a></small>

                        <small v-if="loadingNewEntries">Loading...</small>
                    </td>
                </tr>


                <tr v-for="entry in entries" :key="entry.id">
                    <td :title="entry.content.class" v-if="!$route.query.family_hash">
                        {{truncate(entry.content.class, 70)}}<br>

                        <small class="text-muted">{{truncate(entry.content.message, 100)}}</small>
                    </td>

                    <td class="table-fit" v-if="!$route.query.family_hash && !$route.query.tag">
                        <span>{{entry.content.occurrences}}</span>
                    </td>

                    <td :title="entry.content.message" v-if="$route.query.family_hash">
                        {{truncate(entry.content.message, 80)}}<br>

                        <small class="text-muted">
                    <span v-if="entry.content.user && entry.content.user.email">
                        User: {{ entry.content.user.email }} ({{ entry.content.user.id }})
                    </span>

                            <span v-else>
                        User: N/A
                    </span>
                        </small>
                    </td>

                    <td class="table-fit" :data-timeago="entry.created_at">{{timeAgo(entry.created_at)}}</td>

                    <td class="table-fit">
                        <router-link :to="{name:'exception-preview', params:{id: entry.id}}" class="control-action">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 16">
                                <path d="M16.56 13.66a8 8 0 0 1-11.32 0L.3 8.7a1 1 0 0 1 0-1.42l4.95-4.95a8 8 0 0 1 11.32 0l4.95 4.95a1 1 0 0 1 0 1.42l-4.95 4.95-.01.01zm-9.9-1.42a6 6 0 0 0 8.48 0L19.38 8l-4.24-4.24a6 6 0 0 0-8.48 0L2.4 8l4.25 4.24h.01zM10.9 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path>
                            </svg>
                        </router-link>
                    </td>
                </tr>


                <tr v-if="hasMoreEntries" key="olderEntries" class="dontanimate">
                    <td colspan="100" class="text-center card-bg-secondary py-1">
                        <small><a href="#" v-on:click.prevent="loadOlderEntries" v-if="!loadingMoreEntries">Load Older Entries</a></small>

                        <small v-if="loadingMoreEntries">Loading...</small>
                    </td>
                </tr>
            </transition-group>
        </table>

    </div>
</template>

<script>
    import $ from 'jquery';
    import _ from 'lodash';
    import axios from 'axios';

    export default {
        name: "Index",

        /**
         * The component's data.
         */
        data() {
            return {
                entries: [],
                ready: false,
                lastEntryIndex: '',
                hasMoreEntries: true,
                hasNewEntries: false,
                entriesPerRequest: 50,
                loadingNewEntries: false,
                loadingMoreEntries: false,

                updateTimeAgoTimeout: null,

                newEntriesTimeout: null,
                newEntriesTimer: 2500,

                updateEntriesTimeout: null,
                updateEntriesTimer: 2500,
            };
        },


        /**
         * Prepare the component.
         */
        mounted() {
            document.title = "Exception Logs";

            this.loadEntries((entries) => {
                console.log('mounted');
                this.entries = entries;

                this.checkForNewEntries();

                this.ready = true;
            });

            this.updateTimeAgo();
        },


        /**
         * Clean after the component is destroyed.
         */
        destroyed() {
            clearTimeout(this.newEntriesTimeout);
            clearTimeout(this.updateEntriesTimeout);
            clearTimeout(this.updateTimeAgoTimeout);

            document.onkeyup = null;
        },


        watch: {
            '$route.query': function () {

                console.log('watch');
                clearTimeout(this.newEntriesTimeout);

                this.hasNewEntries = false;
                this.lastEntryIndex = '';

                this.ready = false;

                this.loadEntries((entries) => {
                    this.entries = entries;

                    this.checkForNewEntries();

                    this.ready = true;
                });
            },
        },


        methods: {
            loadEntries(){
                axios.post('/' + LaravelExceptionManager.path + '/exceptions'
                ).then(response => {
                    this.lastEntryIndex = response.data.entries.length ? _.last(response.data.entries).id : this.lastEntryIndex;
                    console.log(this.lastEntryIndex);
                    this.hasMoreEntries = response.data.entries.length >= this.entriesPerRequest;
                })
            },


            /**
             * Keep checking if there are new entries.
             */
            checkForNewEntries(){
                this.newEntriesTimeout = setTimeout(() => {
                    axios.post('/exceptions'
                    ).then(response => {
                        if (response.data.entries.length && !this.entries.length) {
                            this.loadNewEntries();
                        } else if (response.data.entries.length && _.first(response.data.entries).id !== _.first(this.entries).id) {
                            if (this.$root.autoLoadsNewEntries) {
                                this.loadNewEntries();
                            } else {
                                this.hasNewEntries = true;
                            }
                        } else {
                            this.checkForNewEntries();
                        }
                    })
                }, this.newEntriesTimer);
            },


            /**
             * Update the timeago of each entry.
             */
            updateTimeAgo(){
                this.updateTimeAgoTimeout = setTimeout(() => {
                    _.each($('[data-timeago]'), time => {
                        $(time).html(this.timeAgo($(time).data('timeago')));
                    });

                    this.updateTimeAgo();
                }, 60000)
            },


            /**
             * Load more entries.
             */
            loadOlderEntries(){
                this.loadingMoreEntries = true;

                this.loadEntries((entries) => {
                    this.entries.push(...entries);

                    this.loadingMoreEntries = false;
                });
            },


            /**
             * Load new entries.
             */
            loadNewEntries(){
                this.hasMoreEntries = true;
                this.hasNewEntries = false;
                this.lastEntryIndex = '';
                this.loadingNewEntries = true;

                clearTimeout(this.newEntriesTimeout);

                this.loadEntries((entries) => {
                    this.entries = entries;

                    this.loadingNewEntries = false;

                    this.checkForNewEntries();
                });
            }
        }
    }
</script>

<style scoped>

</style>