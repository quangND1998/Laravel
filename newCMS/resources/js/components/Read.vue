    <!-- File: ./resources/app/js/components/Read.vue -->
    <template>
        <div id="posts">
            <p class="border p-3" v-for="post in posts " :key="post.id" >
                {{ post.title }}
                <router-link :to="{ name: 'update', params: { postId : post.id } }">
                    <button type="button" class="p-1 mx-3 float-right btn btn-light">
                        Update
                    </button>
                </router-link>
                <button
                    type="button"
                    @click="deletePost(post.id)"
                    class="p-1 mx-3 float-right btn btn-danger"
                >
                    Delete
                </button>
            </p>
            <div>
                <button
                    v-if="next"
                    type="button"
                    @click="navigate(next)"
                    class="m-3 btn btn-primary"
                >
                  Next
                </button>
                <button
                    v-if="prev"
                    type="button"
                    @click="navigate(prev)"
                    class="m-3 btn btn-primary"
                >
                  Previous
                </button>
            </div>
        </div>
    </template>

<script>
export default {

      mounted() {
        this.getPosts();
      },
      data() {
        return {
          posts: {},
          next: null,
          prev: null
        };
      },

      methods: {


        getPosts(address) {
            var address ='http://127.0.0.1:8000';
            axios.get(address +"/api/posts/index").then(response => {
            this.posts = response.data.data;
            this.prev = response.data.links.prev;
            this.next = response.data.links.next;
          });
        },
        deletePost(id) {
          axios.delete("/api/posts/delete/" +id).then(response => this.getPosts())
        },
        navigate(address) {
            var address ='http://127.0.0.1:8000';
          this.getPosts(address)
        }
      }
    };
</script>
