<template>
    <div>
        <div
            :data-vimeo-id="lesson.video_id"
            id="handstick"
            v-if="lesson"
        ></div>
    </div>
</template>

<script>
import Player from "@vimeo/player";
export default {
    props: ["rawlessons"],
    mounted() {
        const player = new Player("handstick");
        /* play data() {
        return {
            lesson: JSON.parse(this.rawLessons)
        };
    }er.on("play", () => {
            console.log("playing");
        }); */
    },

    data() {
        return {
            lesson: JSON.parse(this.rawlessons)
        };
    }
};
</script>
