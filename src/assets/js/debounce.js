/**
 * @param {Function} anonymousFunction 遅延実行される無名関数
 * @param {number} delay 遅延時間(ms)
 * @returns
 */
export const debounce = (anonymousFunction, delay) => {
  let inDebounce;
  return function () {
    const context = this;
    const args = arguments;
    clearTimeout(inDebounce);
    inDebounce = setTimeout(
      () => anonymousFunction.apply(context, args),
      delay
    );
  };
};
