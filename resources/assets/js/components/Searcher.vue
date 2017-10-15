<template>
	<div class="navbar-form navbar-left">
		<li class="dropdown" :class="{'open': open}">
          	<div class="form-group">
          		<div class="searcher">
          			<input type="text" v-model="data" class="form-control form-search" :class="{'input-search': open}" placeholder="Users search...">
          			<span v-show="data.length" @click="clear" class="input-icon white glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
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
			},
			clear() {
				console.log('cleared');
				this.data = '';
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
	.form-search {
		padding: 0 25px 0 0!important;	
	}
	.input-icon {
	  padding-right: 10px;
	  cursor: pointer;
	  pointer-events: initial;
	}
</style>