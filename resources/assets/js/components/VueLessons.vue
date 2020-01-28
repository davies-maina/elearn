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
    },
    data() {
        return {
            lessons: JSON.parse(this.dblessons)
        };
    },

    methods: {
        createLesson() {
            this.$emit("createNewLesson", this.seriesId);
        }
    },

    computed: {}
};
</script>
