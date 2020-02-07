<template>
    <div class="container">
        <div class="text-center p-3">
            <button
                class="btn btn-primary"
                @click="createLesson"
                data-toggle="modal"
                data-target="#createlessonModal"
            >
                Create lesson
            </button>
        </div>
        <br />
        <hr />
        <ul class="list-group">
            <li
                class="list-group-item"
                v-for="(lesson, index) in lessons"
                :key="index"
            >
                {{ lesson.title }}
                <span class="badge badge-primary badge-pill"
                    ><i
                        class="fa fa-trash"
                        @click="deleteLesson(lesson.id, index)"
                    ></i>
                </span>
                <span class="badge badge-primary badge-pill"
                    ><i
                        class="fa fa-edit"
                        data-toggle="modal"
                        data-target="#createlessonModal"
                        @click="updateLesson(lesson)"
                    ></i>
                </span>
            </li>
        </ul>
        <createlesson></createlesson>
    </div>
</template>

<script>
import createlesson from "./children/CreateLesson";
export default {
    props: ["dblessons", "series-id"],
    components: {
        createlesson
    },
    mounted() {
        this.$on("lessonCreated", data => {
            this.lessons.push(data);
        });

        this.$on("lessonUpdated", data => {
            /* this.lessons.push(data); */
            let lessonIndex = this.lessons.findIndex(l => {
                return data.id == l.id;
            });
            this.lessons.splice(lessonIndex, 1, data);
        });
    },
    data() {
        return {
            lessons: JSON.parse(this.dblessons)
        };
    },

    methods: {
        createLesson() {
            this.$emit("createNewLesson", this.seriesId);
        },
        deleteLesson(id, index) {
            axios.delete(`/admin/${this.seriesId}/lessons/${id}`).then(res => {
                this.lessons.splice(index, 1);
            });
        },

        updateLesson(lesson) {
            let sId = this.seriesId;
            this.$emit("updatingLesson", { lesson, sId });
            /* console.log(sId); */
        }
    },

    computed: {}
};
</script>
