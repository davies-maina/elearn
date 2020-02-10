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
import Swal from "sweetalert2";
export default {
    props: ["rawlessons", "nextlesson"],
    mounted() {
        const player = new Player("handstick");
        /* play data() {
        return {
            lesson: JSON.parse(this.rawLessons)
        };
    }er.on("play", () => {
            console.log("playing");
        }); */

        player.on("ended", () => {
            this.displayVideoEndedText();
        });
    },

    data() {
        return {
            lesson: JSON.parse(this.rawlessons)
        };
    },

    methods: {
        displayVideoEndedText() {
            if (this.nextlesson) {
                Swal.fire({
                    text: "You have finished this lesson",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    window.location = this.nextlesson;
                });
            } else {
                Swal.fire({
                    text: "Congrats! you completed this series!",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            }
        }
    }
};
</script>
