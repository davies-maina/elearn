<template>
    <div>
        <div data-vimeo-id="19231868" id="handstick"></div>
    </div>
</template>

<script>
import Player from "@vimeo/player";
export default {
    mounted() {
        const player = new Player("handstick");
        player.on("play", () => {
            console.log("playing");
        });
    }
};
</script>
