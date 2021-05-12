let merParam = {};

if (typeof mercuryParam != "undefined") {
    merParam = mercuryParam;
}

let sdk = new MercurySDK({
    checkoutUrl: "/mercury/transaction/create",
    statusUrl: "/mercury/status/check",
    checkStatusInterval: parseInt(merParam.time, 2),
    mount: "#mercury-cash",
    lang: "en",
    limits: {
        BTC: merParam.btc,
        ETH: merParam.eth,
        DASH: merParam.dash
    }
});
