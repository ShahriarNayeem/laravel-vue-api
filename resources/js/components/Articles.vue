<template>
    <div>
        <h2>Articles</h2>

        <form class="mb-3" @submit.prevent="addArticle">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Title" v-model="article.title">
            </div>
            <div class="form-group">
                <textarea class="form-control" placeholder="Body" v-model="article.body"></textarea>
            </div>
            <button type="submit" class="btn btn-light btn-block">Save</button>
        </form>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li :class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="fetchArticles(pagination.prev_page_url)">Previous</a></li>

                <li class="page-item disabled"><a class="page-link text-dark" href="#">
                    Page {{ pagination.current_page }} of {{ pagination.last_page }}
                </a></li>

                <li :class="[{disabled: !pagination.next_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="fetchArticles(pagination.next_page_url)">Next</a></li>
            </ul>
        </nav>

        <div class="card card-body mb-2" v-for="article in articles" :key="article.id">
            <h3>{{ article.title }}</h3>
            <p>{{ article.body }}</p>
            <hr>
            <button class="btn btn-danger mb-2" @click="deleteArticle(article.id)">Delete</button>
            <button class="btn btn-warning" @click="editArticle(article)">Edit</button>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                articles: [],
                article: {
                    id: '',
                    title: '',
                    body: ''
                },
                pagination: {},
                edit: false
            }
        },
        created() {
            this.fetchArticles()
        },
        mounted() {
            console.log("Articles Component Mounted")
        },
        methods: {
            fetchArticles(page_url) {

                let vm = this;
                page_url = page_url || 'api/articles';
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.articles = res.data;
                        vm.makePagination(res.meta, res.links)
                    })
                    .catch(err => console.log(err))
            },
            makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev,
                };
                this.pagination = pagination
            },
            deleteArticle(id) {
                if (confirm('Are you sure?')) {
                    fetch(`api/article/${id}`, {
                        method: 'delete'
                    }).then(res => res.json())
                        .then(data => {
                            alert('Article Removed');
                            this.fetchArticles()
                        })
                        .catch(err => console.log(err))
                }
            },
            addArticle() {
                if (this.edit === true) {
                    fetch(`api/article/${this.article.id}`, {
                        method: 'put',
                        body: JSON.stringify(this.article),
                        headers: {
                            'content-type': 'application/json'
                        }
                    }).then(res => res.json())
                        .then(data => {
                            this.edit = false;
                            this.article.title = '';
                            this.article.body = '';
                            this.fetchArticles();
                        })
                        .catch(err => console.log(err));
                } else {
                    fetch('api/article', {
                        method: 'post',
                        body: JSON.stringify(this.article),
                        headers: {
                            'content-type': 'application/json'
                        }
                    }).then(res => res.json())
                        .then(data => {
                            this.article.title = '';
                            this.article.body = '';
                            this.fetchArticles();
                        })
                        .catch(err => console.log(err))
                }
            },
            editArticle(article) {
                this.edit = true;
                this.article.id = article.id;
                this.article.title = article.title;
                this.article.body = article.body;
            }
        }
    }
</script>

<style scoped>

</style>
