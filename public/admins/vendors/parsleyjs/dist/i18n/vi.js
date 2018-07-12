// This is included with the Parsley library itself,
// thus there is no use in adding it to your project.

Parsley.addMessages("en", {
    defaultMessage: "Giá trị này có vẻ không hợp lệ.",
    type:           {
        email:    "Giá trị này phải là một email hợp lệ.",
        url:      "Giá trị này phải là url hợp lệ.",
        number:   "Giá trị này phải là số hợp lệ.",
        integer:  "Giá trị này phải là một số nguyên hợp lệ.",
        digits:   "Giá trị này phải là chữ số.",
        alphanum: "Giá trị này phải là chữ và số."
    },
    notblank:       "không nên bỏ qua cái giá trị này\n.",
    required:       "Giá trị này là bắt buộc.",
    pattern:        "Giá trị này có vẻ không hợp lệ.",
    min:            "Giá trị này phải lớn hơn hoặc bằng %s.",
    max:            "Giá trị này phải nhỏ hơn hoặc bằng %s.",
    range:          "Giá trị này phải nằm giữa %s và %s.",
    minlength:      "Giá trị này quá ngắn. Nó nên có %s ký tự trở lên.",
    maxlength:      "Giá trị này quá dài. Nó nên có %s ký tự trở xuống.",
    length:         "Độ dài giá trị này không hợp lệ.. Nó phải ở giữa %s và %s kí tự.",
    mincheck:       "bạn phải chọn ít nhất %s lựa chọn.",
    maxcheck:       "Bạn phải chọn %s lựa chọn hoặc ít hơn.",
    check:          "Bạn phải chọn giữa %s và %s lựa chọn.",
    equalto:        "Giá trị này phải giống nhau."
});

Parsley.setLocale("vi");
