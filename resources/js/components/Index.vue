<template>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5>Exception Logs</h5>
        </div>


        <!--<div v-if="!ready" class="d-flex align-items-center justify-content-center card-bg-secondary p-5 bottom-radius">-->
            <!--<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="icon spin mr-2 fill-text-color">-->
                <!--<path d="M12 10a2 2 0 0 1-3.41 1.41A2 2 0 0 1 10 8V0a9.97 9.97 0 0 1 10 10h-8zm7.9 1.41A10 10 0 1 1 8.59.1v2.03a8 8 0 1 0 9.29 9.29h2.02zm-4.07 0a6 6 0 1 1-7.25-7.25v2.1a3.99 3.99 0 0 0-1.4 6.57 4 4 0 0 0 6.56-1.42h2.1z"></path>-->
            <!--</svg>-->

            <!--<span>Scanning...</span>-->
        <!--</div>-->


        <!--<div v-if="ready && entries.length == 0" class="d-flex flex-column align-items-center justify-content-center card-bg-secondary p-5 bottom-radius">-->
            <!--<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60" class="fill-text-color" style="width: 200px;">-->
                <!--<path fill-rule="evenodd" d="M7 10h41a11 11 0 0 1 0 22h-8a3 3 0 0 0 0 6h6a6 6 0 1 1 0 12H10a4 4 0 1 1 0-8h2a2 2 0 1 0 0-4H7a5 5 0 0 1 0-10h3a3 3 0 0 0 0-6H7a6 6 0 1 1 0-12zm14 19a1 1 0 0 1-1-1 1 1 0 0 0-2 0 1 1 0 0 1-1 1 1 1 0 0 0 0 2 1 1 0 0 1 1 1 1 1 0 0 0 2 0 1 1 0 0 1 1-1 1 1 0 0 0 0-2zm-5.5-11a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm24 10a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm1 18a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm-14-3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm22-23a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM33 18a1 1 0 0 1-1-1v-1a1 1 0 0 0-2 0v1a1 1 0 0 1-1 1h-1a1 1 0 0 0 0 2h1a1 1 0 0 1 1 1v1a1 1 0 0 0 2 0v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 0-2h-1z"></path>-->
            <!--</svg>-->

            <!--<span>We didn't find anything - just empty space.</span>-->
        <!--</div>-->


        <!--<table id="indexScreen" class="table table-hover table-sm mb-0 penultimate-column-right" v-if="ready && entries.length > 0">-->
            <!--<thead>-->
                <!--<tr slot="table-header">-->
                    <!--<th scope="col" v-if="!$route.query.family_hash">Type</th>-->
                    <!--<th scope="col" v-if="!$route.query.family_hash && !$route.query.tag">Occurrences</th>-->
                    <!--<th scope="col" v-if="$route.query.family_hash">Message</th>-->
                    <!--<th scope="col">Happened</th>-->
                    <!--<th scope="col"></th>-->
                <!--</tr>-->
            <!--</thead>-->


            <!--<transition-group tag="tbody" name="list">-->
                <!--<tr v-if="hasNewEntries" key="newEntries" class="dontanimate">-->
                    <!--<td colspan="100" class="text-center card-bg-secondary py-1">-->
                        <!--<small><a href="#" v-on:click.prevent="loadNewEntries" v-if="!loadingNewEntries">Load New Entries</a></small>-->

                        <!--<small v-if="loadingNewEntries">Loading...</small>-->
                    <!--</td>-->
                <!--</tr>-->


                <!--<tr v-for="entry in entries" :key="entry.id">-->
                    <!--<slot name="row" :entry="entry"></slot>-->
                <!--</tr>-->


                <!--<tr v-if="hasMoreEntries" key="olderEntries" class="dontanimate">-->
                    <!--<td colspan="100" class="text-center card-bg-secondary py-1">-->
                        <!--<small><a href="#" v-on:click.prevent="loadOlderEntries" v-if="!loadingMoreEntries">Load Older Entries</a></small>-->

                        <!--<small v-if="loadingMoreEntries">Loading...</small>-->
                    <!--</td>-->
                <!--</tr>-->
            <!--</transition-group>-->
        <!--</table>-->

    </div>
</template>

<script>
    export default {
        name: "Index"
    }
</script>

<style scoped>

</style>