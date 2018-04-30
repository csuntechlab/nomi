export default {
    studentProfile: state => state.studentProfile,
    sp_student_id : state => state.studentProfile.id,
    sp_emailURI : state => state.studentProfile.emailURI,
    sp_display_name: state => state.studentProfile.displayName,
    sp_bio: state => state.studentProfile.bio,
    sp_images: state => state.studentProfile.images,
    sp_image_priority: state => state.studentProfile.imagePriority,
    sp_notes: state => state.studentProfile.notes,
}