<template>
	<div class="navbar-form navbar-left">
		<li class="dropdown" :class="{'open': open}">
          	<div class="form-group">
          		<div class="searcher">
          			<input type="text" v-model="data" class="form-control" :class="{'input-search': open}" placeholder="Search for users...">
          		</div>
        	</div>
          	<ul class="dropdown-menu no-br">
          		<li v-for="result in results">
          			<a :href="'/id' + result.id">
                        <div class="card-horizontal row">
                            <div class="col-md-3">
                                <img :src="'/storage/avatars/' + result.avatar" width="40" class="avatar profile-avatar" alt="avatar">
                            </div>
                            <div class="col-md-9">
                            		<template v-if="(result.first_name && result.last_name)">
	                            		<h6 class="mb-0 mt-5p">
	                            			{{ result.first_name + ' ' + result.last_name }}
	                            		</h6>
                                        <span class="mt-0 mb-0">@{{ result.username }}</span>
                            		</template>
                            		<template v-else>
                            			<h6 class="mb-0">
	                            			{{ result.username }}
	                            		</h6>
                            		</template>
                            </div>
                        </div>
          			</a>
          		</li>
	            <li role="separator" class="divider"></li>
	            <li><a href="/users" class="text-center"><strong>All users</strong></a></li>
          	</ul>
        </li>
    </div>
</template>

<script>
	export default {
		data() {
			return {
				data: '',
				results: ''
			}
		},
		computed: {
			open() {
				return this.data.length && this.results;
			}
		},
		watch: {
			data() {
				if (this.data.length) {
					this.search();
				}
			}
		},
		methods: {
			search() {
				axios.post('/api/search', {'query': this.data})
					.then(response => {
						this.results = response.data;
					})
			}
		}
	}
</script>

<style>
	.no-br {
		border-radius: initial;
		width: 100%;
	}
	.input-search {
		box-shadow: none!important;
	}
	.searcher {
		padding: 0 15px;
	}
</style>