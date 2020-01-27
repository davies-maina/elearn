<template>
    <div class="container">
        <div
            class="modal fade"
            id="createlessonModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby=""
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">
                            Create lesson
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Lesson title"
                                v-model="data.title"
                            />
                        </div>
                        <div class="form-group">
                            <input
                                type="number"
                                class="form-control"
                                placeholder="video id"
                                v-model="data.video_id"
                            />
                        </div>
                        <div class="form-group">
                            <input
                                type="number"
                                class="form-control"
                                placeholder="Episode no."
                                v-model="data.episode_number"
                            />
                        </div>
                        <div class="form-group">
                            <textarea
                                cols="30"
                                rows="10"
                                class="form-control"
                                v-model="data.description"
                            ></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="saveLesson"
                        >
                            Save Lesson
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    mounted() {
        this.$parent.$on("createNewLesson", seriesId => {
            this.series_id = seriesId;
            console.log("creatying");
        });
    },

    data() {
        return {
            data: {
                title: "",
                description: "",
                video_id: "",
                episode_number: "",
                series_id: ""
            }
        };
    },

    methods: {
        saveLesson() {
            axios
                .post(`/admin/${this.series_id}/lessons`, this.data)

                .then(res => {
                    console.log(res);
                });
        }
    }
};
</script>
