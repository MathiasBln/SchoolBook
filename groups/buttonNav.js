let Post = document.getElementById("postTest");
let Members = document.getElementById("members");
let ButtonPosts = document.getElementById("buttonPosts");
let ButtonMembers = document.getElementById("buttonMembers");

function switchToPost() {
    Post.style.display='block';
    Members.style.display='none';
}

function switchToMembers() {
    Post.style.display='none';
    Members.style.display='block';
}

ButtonPosts.onclick=switchToPost;
ButtonMembers.onclick=switchToMembers;