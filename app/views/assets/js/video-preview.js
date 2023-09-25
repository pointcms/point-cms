document.addEventListener("DOMContentLoaded", () => {
  const videoLinkInput = document.getElementById("video-link");
  const previewButton = document.getElementById("preview-button");
  const previewContainer = document.getElementById("video-preview");

  previewButton.addEventListener("click", () => {
    showPreview();
  });

  videoLinkInput.addEventListener("input", () => {
    showPreview();
  });

  function showPreview() {
    const videoLink = videoLinkInput.value;

    if (isYouTubeLink(videoLink)) {
      const videoId = getVideoIdFromYouTubeLink(videoLink);
      showVideoPreview("youtube", videoId);
    } else if (isVimeoLink(videoLink)) {
      const videoId = getVideoIdFromVimeoLink(videoLink);
      showVideoPreview("vimeo", videoId);
    } else {
      previewContainer.innerHTML = "Invalid video link";
    }
  }

  function isYouTubeLink(link) {
    return /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)/.test(link);
  }

  function getVideoIdFromYouTubeLink(link) {
    const regex = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=|embed\/|v\/)?([a-zA-Z0-9_-]{11})/;
    const match = link.match(regex);
    return match ? match[1] : null;
  }

  function isVimeoLink(link) {
    return /(?:https?:\/\/)?(?:www\.)?vimeo\.com/.test(link);
  }

  function getVideoIdFromVimeoLink(link) {
    const regex = /(?:https?:\/\/)?(?:www\.)?vimeo\.com\/(\d+)/;
    const match = link.match(regex);
    return match ? match[1] : null;
  }

  function showVideoPreview(provider, videoId) {
    let embedUrl = "";

    if (provider === "youtube") {
      embedUrl = `https://www.youtube.com/embed/${videoId}`;
    } else if (provider === "vimeo") {
      embedUrl = `https://player.vimeo.com/video/${videoId}`;
    }

    const previewHTML = `<iframe src="${embedUrl}" frameborder="0" allowfullscreen></iframe>`;

    previewContainer.innerHTML = previewHTML;
  }

  // Check and show preview if input field is already populated on page load
  if (videoLinkInput.value.trim() !== "") {
    showPreview();
  } else {
    document.getElementById("video-preview").innerHTML = "<div class=\"mt-5\">No value entered</div>";
  }
});