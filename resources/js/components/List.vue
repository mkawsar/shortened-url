<template>
    <div class="container overflow-hidden">
        <div class="container overflow-hidden">
            <div class="row gy-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">Shortened URL Form</div>

                        <div class="card-body">
                            I'm an example component.
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">Shortened URL List</div>

                        <div class="card-body">
                            <template>
                                <vuetable
                                    ref="vuetable"
                                    :api-url="url"
                                    :fields="fields"
                                    pagination-path
                                    :css="css.table"
                                    @vuetable:loading="showLoader"
                                    @vuetable:loaded="hideLoader"
                                    @vuetable:pagination-data="onPaginationData"
                                >
                                    <template slot="links" slot-scope="props">
                                        <div class="custom-actions">
                                            <a href="javascript:void(0)" @click="handleRedirect(props.rowData.code)">
                                                {{baseUrl + '/' + props.rowData.code}}
                                            </a>
                                        </div>
                                    </template>
                                </vuetable>
                                <div class="vuetable-pagination ui basic segment grid">
                                    <vuetable-pagination-info ref="paginationInfo"></vuetable-pagination-info>

                                    <vuetable-pagination
                                        ref="pagination"
                                        :css="css.pagination"
                                        @vuetable-pagination:change-page="onChangePage"
                                    ></vuetable-pagination>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Vuetable from "vuetable-2";
import VuetablePagination from "vuetable-2/src/components/VuetablePagination";
import VuetablePaginationInfo from "vuetable-2/src/components/VuetablePaginationInfo";

export default {
    mounted() {
        this.baseUrl = window.location.origin;
    },
    components: {
        Vuetable, VuetablePagination, VuetablePaginationInfo
    },
    data() {
        return {
            baseUrl: '',
            css: {
                table: {
                    tableClass: "table table-striped table-bordered",
                    ascendingIcon: "glyphicon glyphicon-chevron-up",
                    descendingIcon: "glyphicon glyphicon-chevron-down",
                    handleIcon: "glyphicon glyphicon-menu-hamburger",
                    renderIcon: function (classes, options) {
                        return `<span class="${classes.join(' ')}"></span>`
                    }
                },
                paginationInfo: {
                    infoClass: 'pull-left'
                },
                pagination: {
                    wrapperClass: "pagination pull-right",
                    activeClass: "btn btn-primary",
                    disabledClass: "disabled",
                    pageClass: "btn btn-default",
                    linkClass: "btn btn-default",
                    icons: {
                        first: "",
                        prev: "",
                        next: "",
                        last: ""
                    }
                }
            },
            fields: [
                {
                    name: 'code',
                    title: 'Code'
                },
                {
                    name: '__slot:links',
                    title: 'Link',
                    titleClass: 'center aligned',
                    dataClass: 'center aligned',
                }
            ],
            url: '/api/v1/short/link/list'
        }
    },
    methods: {
        onPaginationData(paginationData) {
            this.$refs.pagination.setPaginationData(paginationData);
            this.$refs.paginationInfo.setPaginationData(paginationData);
        },
        onChangePage(page) {
            this.$refs.vuetable.changePage(page)
        },
        showLoader() {
            this.loading = true;
        },
        hideLoader() {
            this.loading = false;
        },
        handleRedirect(code) {
            axios.get(`/api/v1/get/${code}/shorten/link`)
                .then(res => {
                    window.open(res.data.data.link);
                })
                .catch(err => {
                    console.log(err)
                });
        }
    }
}
</script>
