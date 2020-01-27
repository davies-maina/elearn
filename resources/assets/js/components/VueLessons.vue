<template>
    <div class="container">
        <ul class="list-group">
            <li
                class="list-group-item"
                v-for="(lesson, index) in formattedLessons"
                :key="index"
            >
                {{ lesson.title }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: ["dblessons"],
    data() {
        return {
            lessons: this.dblessons
        };
    },

    computed: {
        formattedLessons() {
            return JSON.parse(this.lessons);
        }
    }
};
</script>
