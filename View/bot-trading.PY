import websocket
import json
import time

def on_open(ws):
    print("Connection opened")
    subscribe_to_ticks(ws, "R_50")  # Adaptez avec le symbole que vous souhaitez suivre

def on_message(ws, message):
    message = json.loads(message)
    if 'tick' in message:
        tick_data = message['tick']
        print(f"Received tick: {tick_data}")
        ticks.append(tick_data)
        if len(ticks) > 10:
            ticks.pop(0)
        if should_place_trade(ticks):
            print("Conditions met for trading. Attempting to place trade...")
            place_trade(ws)
    elif 'buy' in message:  # Réponse de l'API après un trade
        trade_result = message['buy']
        if trade_result['status'] == 'success':
            print(f"Trade ID {trade_result['transaction_id']} successful. Payout: {trade_result['payout']}")
        else:
            print(f"Trade failed. Error: {trade_result['error_message']}")
    else:
        print("Received message:", message)

def on_error(ws, error):
    print("An error occurred:", error)

def on_close(ws):
    print("Connection closed")

def subscribe_to_ticks(ws, symbol):
    msg = json.dumps({"ticks": symbol, "subscribe": 1})
    ws.send(msg)

def should_place_trade(ticks):
    # Votre logique de décision de trade
    last_digit_zero = str(ticks[-1]['quote'])[-1] == '0'
    zero_count = sum([1 for tick in ticks[-10:] if str(tick['quote'])[-1] == '0']) < 2
    last_tick_up = ticks[-1]['quote'] > ticks[-2]['quote']
    return last_digit_zero and zero_count and last_tick_up

def place_trade(ws):
    trade_parameters = {
        "amount": 2,  # Votre mise
        "basis": "stake",
        "contract_type": "DIGITMATCH",  # Type de contrat
        "currency": "EUR",
        "duration": 1,
        "duration_unit": "t",
        "symbol": "R_50",
        "barrier": "0",
    }
    ws.send(json.dumps({"buy": 1, "price": 2, "parameters": trade_parameters, "subscribe": 1}))
    print("Trade request sent.")

if __name__ == "__main__":
    ticks = []
    api_token = 'pH4NTcrwHx67frp'  # Remplacez par votre token API valide
    websocket_url = f"wss://ws.binaryws.com/websockets/v3?app_id=1089&l=FR&token={api_token}"

    ws = websocket.WebSocketApp(websocket_url,
                                on_message=on_message,
                                on_error=on_error,
                                on_close=on_close)
    ws.on_open = on_open
    ws.run_forever()
