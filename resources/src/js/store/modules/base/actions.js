export default {
    // General
	getAllUserData(context) {
        context.commit("GET_SETTINGS");
		context.commit("GET_DATA");
	},

	getOnlyData(context) {
        context.commit("GET_DATA");
	},
    
	getOnlySettings(context) {
        context.commit("GET_SETTINGS");
	},
    
	clearErrors(context) {
        context.commit("CLEAR_ERRORS");
	},
    
	toggleMenu(context) {
        context.commit("TOGGLE_MENU");
	},
    
    handlePermissionResponse(context, payload) {
        context.commit("HANDLE_PERMISSION_RESPONSE", payload);
    },
    
    nullifyPermissionResponse(context) {
        context.commit("NULLIFY_PERMISSION_RESPONSE");
    },
    
	updateImage(context, payload) {
        context.commit("UPDATE_IMAGE", payload);
	},

	updateStudentPriority(context, payload) {
		context.commit("UPDATE_STUDENT_PRIORITY", payload);
	},
	// Views & Sorting
	setList(context) {
		context.commit("SET_LIST");
	},

	setGallery(context) {
		context.commit("SET_GALLERY");
	},

	setFlash(context) {
		context.commit("SET_FLASH");
	},

	shuffleFlash(context) {
		context.commit("SHUFFLE_FLASH");
	},

	sortFirstName(context) {
		context.commit("SORT_FIRST_NAME");
		context.commit("SORT_ROSTER");
	},

	sortLastName(context) {
		context.commit("SORT_LAST_NAME");
		context.commit("SORT_ROSTER");
	},

	sortDescending(context) {
		context.commit("SORT_DSC");
		context.commit("SORT_ROSTER");
	},

	sortAscending(context) {
		context.commit("SORT_ASC");
		context.commit("SORT_ROSTER");
	},

	// Back Button
	hideBackButton(context) {
		context.commit("HIDE_BACK_BUTTON");
	},

	showBackButton(context) {
		context.commit("SHOW_BACK_BUTTON");
	},

	disableBackButton(context) {
		context.commit("DISABLE_BACK_BUTTON");
	},

	enableBackButton(context) {
		context.commit("ENABLE_BACK_BUTTON");
    },
    
    // Courses
	setSpring(context) {
		context.commit("SET_SPRING");
	},

	setSummer(context) {
		context.commit("SET_SUMMER");
	},

	setFall(context) {
		context.commit("SET_FALL");
	},

	setWinter(context) {
		context.commit("SET_WINTER");
	},

	setTermYear(context, payload) {
		context.commit("SET_TERM_YEAR", payload);
	},

	loadingClassesTrue(context) {
		context.commit("SET_CLASS_IS_LOADING");
	},

	doneLoadingClasses(context) {
		context.commit("SET_CLASS_DONE_LOADING");
    },
    
    storeCourse(context, payload) {
        context.commit("STORE_COURSE", payload);
    },

    storeLocation(context, payload){
		context.commit("STORE_LOCATION", payload);
	},

	setPreviousTerm(context, payload){
		context.commit("SET_PREVIOUS_TERM");
		context.commit("GET_DATA");
	},

	setCurrentTerm(context, payload){
		context.commit("SET_CURRENT_TERM");
		context.commit("GET_DATA");
	},

	setNextTerm(context, payload){
		context.commit("SET_NEXT_TERM");
		context.commit("GET_DATA");
	},

	setSem(payload){
		context.commit("SET_SEM");
	}

};
