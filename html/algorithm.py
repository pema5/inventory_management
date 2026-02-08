# Import required libraries
import pandas as pd
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LinearRegression
from sklearn.metrics import mean_squared_error, r2_score

# Load historical sales data
# Example CSV columns: Day, Sales
data = pd.read_csv("sales_data.csv")

# Independent variable (Day / Month / Time)
X = data[['Day']]   # must be 2D
# Dependent variable (Sales)
y = data['Sales']

# Split data into training and testing sets (80% train, 20% test)
X_train, X_test, y_train, y_test = train_test_split(
    X, y, test_size=0.2, random_state=42
)

# Create Linear Regression model
model = LinearRegression()

# Train the model
model.fit(X_train, y_train)

# Predict sales for test data
y_pred = model.predict(X_test)

# Evaluate the model
mse = mean_squared_error(y_test, y_pred)
r2 = r2_score(y_test, y_pred)

print("Mean Squared Error:", mse)
print("R-squared Score:", r2)

# Predict upcoming (future) sales
# Example: predicting sales for Day 31, 32, 33
future_days = np.array([[31], [32], [33]])
future_sales = model.predict(future_days)

print("Predicted Future Sales:")
for day, sale in zip(future_days.flatten(), future_sales):
    print(f"Day {day}: {sale:.2f}")
