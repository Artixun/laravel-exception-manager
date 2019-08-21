<script type="text/ecmascript-6">
    import _ from 'lodash';
    import axios from 'axios';


    export default {
        components: {
            'code-preview': require('../components/ExceptionCodePreview'),
            'stack-trace': require('../components/Stacktrace')
        },

        /**
         * The component's data.
         */
        data() {
            return {
                entry: null,
                ready: false,
                currentTab: 'message',
                updateEntryTimeout: null,
                updateEntryTimer: 2500,
            };
        },


        /**
         * Prepare the component.
         */
        mounted() {
            this.prepareEntry()
        },


        /**
         * Clean after the component is destroyed.
         */
        destroyed() {
            clearTimeout(this.updateEntryTimeout);
        },

        methods: {
            prepareEntry() {
                document.title = "Exception Detail";
                this.ready = false;

                let unwatch = this.$watch('ready', newVal => {
                    if (newVal) {
                        this.$emit('ready');
                        unwatch();
                    }
                });

                this.loadEntry((response) => {
                    this.entry = response.data.entry;

                    this.$parent.entry = response.data.entry;

                    this.ready = true;
                });
            },


            loadEntry(after){
                axios.get('/' + LaravelExceptionManager.path + '/exception-manager-api/exceptions/' + this.$route.params.id).then(response => {
                    if (_.isFunction(after)) {
                        after(response);
                    }
                }).catch(error => {
                    this.ready = true;
                })
            }
        }
    }
</script>

<template>
    <div>
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5>Exception Details</h5>
            </div>


            <div v-if="!ready" class="d-flex align-items-center justify-content-center card-bg-secondary p-5 bottom-radius">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="icon spin mr-2">
                    <path d="M12 10a2 2 0 0 1-3.41 1.41A2 2 0 0 1 10 8V0a9.97 9.97 0 0 1 10 10h-8zm7.9 1.41A10 10 0 1 1 8.59.1v2.03a8 8 0 1 0 9.29 9.29h2.02zm-4.07 0a6 6 0 1 1-7.25-7.25v2.1a3.99 3.99 0 0 0-1.4 6.57 4 4 0 0 0 6.56-1.42h2.1z"></path>
                </svg>

                <span>Fetching...</span>
            </div>


            <div v-if="ready && !entry" class="d-flex align-items-center justify-content-center card-bg-secondary p-5 bottom-radius">
                <span>No entry found.</span>
            </div>


            <div class="table-responsive">
                <table v-if="ready && entry" class="table mb-0 card-bg-secondary table-borderless">
                    <tbody>
                    <tr>
                        <td class="table-fit font-weight-bold">Time</td>
                        <td>
                            {{localTime(entry.created_at)}} ({{timeAgo(entry.created_at)}})
                        </td>
                    </tr>

                    <tr>
                        <td class="table-fit font-weight-bold">Hostname</td>
                        <td>
                            {{entry.content.hostname}}
                        </td>
                    </tr>

                    <tr>
                        <td class="table-fit font-weight-bold">Type</td>
                        <td>
                            {{entry.content.class}}
                        </td>
                    </tr>

                    <tr>
                        <td class="table-fit font-weight-bold">Location</td>
                        <td>
                            {{entry.content.file}}:{{entry.content.line}}
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <div v-if="ready && entry" class="mt-5">
            <div class="card mt-5">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link" :class="{active: currentTab=='message'}" href="#" v-on:click.prevent="currentTab='message'">Message</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :class="{active: currentTab=='location'}" href="#" v-on:click.prevent="currentTab='location'">Location</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :class="{active: currentTab=='trace'}" href="#" v-on:click.prevent="currentTab='trace'">Stacktrace</a>
                    </li>
                </ul>

                <div>
                    <pre class="code-bg p-4 mb-0 text-white" v-show="currentTab=='message'">{{entry.content.message}}</pre>

                    <code-preview
                            v-show="currentTab=='location'"
                            :lines="entry.content.line_preview"
                            :highlighted-line="entry.content.line">
                    </code-preview>

                    <stack-trace :trace="entry.content.trace" v-show="currentTab=='trace'"></stack-trace>
                </div>
            </div>
        </div>
    </div>
</template>