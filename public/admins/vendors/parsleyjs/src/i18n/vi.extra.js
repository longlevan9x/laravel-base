// Validation errors messages for Parsley
import Parsley from "../parsley";

Parsley.addMessages("vi", {
    dateiso:    "Giá trị này phải là ngày hợp lệ (YYYY-MM-DD).",
    minwords:   "Giá trị này quá ngắn. Nó nên có %s từ hoặc nhiều hơn.",
    maxwords:   "Giá trị này quá dài. Nó nên có %s từ hoặc ít hơn.",
    words:      "Độ dài giá trị này không hợp lệ. Nó phải ở giữa %s và %s từ.",
    gt:         "Giá trị này phải lớn hơn.",
    gte:        "Giá trị này phải lớn hơn hoặc bằng.",
    lt:         "Giá trị này phải nhỏ hơn.",
    lte:        "Giá trị này phải nhỏ hơn hoặc bằng.",
    notequalto: "Giá trị này phải khác."
});
