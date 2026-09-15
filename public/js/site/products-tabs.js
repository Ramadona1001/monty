document.addEventListener("DOMContentLoaded", function () {
  const tabList = document.getElementById("productCategoryTabs");
  if (!tabList) return;

  tabList.addEventListener("shown.bs.tab", function (event) {
    const activeTab = event.target;
    if (!activeTab || typeof activeTab.scrollIntoView !== "function") return;

    activeTab.scrollIntoView({
      behavior: "smooth",
      block: "nearest",
      inline: "center",
    });
  });
});
